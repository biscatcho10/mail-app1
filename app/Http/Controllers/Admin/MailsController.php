<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MailsDataTable;
use App\Http\Controllers\Controller;
use App\Imports\EmailsImport;
use App\Models\Category;
use App\Models\Email;
use App\Models\Mail;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailsController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param MailsDataTable $mailsDataTable
     * @return Application|Factory|View
     */
    public function index(MailsDataTable $mailsDataTable)
    {
        return $mailsDataTable->render('admin.components.mail.datatable');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $mail = new Mail();
        $allCategories = Category::all();
        $categories = [];
        $categories[0] = null;
        foreach ($allCategories as $cat)
            $categories[$cat->id] = $cat->name;

        $allEmails = Email::all();
        $emails = [];
        $emails[0] = null;
        foreach ($allEmails as $e)
            $emails[$e->id] = $e->email;
        return view('admin.components.mail.create', compact('mail', 'categories', 'emails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        if ($input['datetime'] == null) {
            $input['sent_time'] = Carbon::now();
            $input['scheduled'] = 0;
        } else {
            $input['sent_time'] = Carbon::parse($input['datetime']);;
            $input['scheduled'] = 1;
        }

        $validator = Validator::make($input, [
            'emails' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('mails.create')->withErrors($validator)->withInput();
        }
        $input['sender'] = env('MAIL_FROM_ADDRESS');
        $input['receiver'] = $input['emails'];
        $input['receiver'] = json_encode($input['receiver']);

        $details = [
            'message' => $input['message'],
            'subject' => $input['subject'],
            'receiver' => json_decode($input['receiver'], true)
        ];
        if ($input['scheduled'] == 0) {
            foreach ($details['receiver'] as $email) {
                $this->composeEmail($email, $input['subject'], $input['message']);
                //                MailGlobal::to($email)->send(new SendEmail($details));
            }
            $input['is_sent'] = 1;
        }
        Mail::create($input);
        return redirect()->route('mails.index')->with(['success' => 'Mail ' . __("messages.add")]);
    }

    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * @return bool
     */
    public function composeEmail(string $to, string $subject, string $message): bool
    {
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->Host = env("MAIL_HOST");             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = env("MAIL_USERNAME");   //  sender username
            $mail->Password = env("MAIL_PASSWORD");       // sender password
            $mail->SMTPSecure = env("MAIL_ENCRYPTION");                  // encryption - ssl/tls
            $mail->Port = env("MAIL_PORT");                          // port - 587/465
            $mail->setFrom(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));
            $mail->addAddress($to);
            $mail->isHTML(true);                // Set email content format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \never
     */
    public function show(int $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $mail = Mail::findorfail($id);
        $allCategories = Category::all();
        $categories = [];
        $categories[0] = null;
        foreach ($allCategories as $cat)
            $categories[$cat->id] = $cat->name;

        $allEmails = Email::all();
        $emails = [];
        $emails[0] = null;
        foreach ($allEmails as $e)
            $emails[$e->id] = $e->email;
        return view('admin.components.mail.edit', compact('mail', 'categories', 'emails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $input = $request->except(["_token", "_method"]);
        if (!$input['is_schedule']) {
            $input['sent_time'] = Carbon::now();
            $input['scheduled'] = 0;
        } else {
            $input['sent_time'] = Carbon::parse($input['datetime'])->format("Y-m-d H:i:s");
            $input['scheduled'] = 1;
        }
        $input['receiver'] = $input['emails'];
        unset($input['is_schedule'], $input['datetime'], $input['emails']);
        $mail = Mail::find($id);
        $mail->update($input);
        return redirect()->route('mails.index')->with(['success' => 'Mail ' . __("messages.update")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $mail = Mail::findOrFail($id);
        $mail->delete();
        return redirect()->route('mails.index')->with(['success' => 'Mail ' . __("messages.delete")]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request): RedirectResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'file' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('mails.importView')->withErrors($validator)->withInput();
        }
        $temp = Excel::toArray(new EmailsImport, $input['file']);
        $rows = $temp[0];
        $emails_id = [];
        foreach ($rows as $row) {
            if ($row['email'] !== null && $row['email'] !== '') {
                $row['category'] = Category::firstOrCreate(['name' => strtolower($row['category'])]);
                $email = Email::where('email', $row['email'])->first();
                if ($email != null) {
                    if (!$email->categories->contains($row['category']->id)) {
                        $email->categories()->attach($row['category']);
                    }
                    $emails_id[] = $email->email;
                } else {
                    $category = $row['category'];
                    unset($row['category']);
                    $email = Email::firstOrCreate($row);
                    $email->categories()->attach($category);
                    $emails_id[] = $email->email;
                }
            }
        }
        //        $emails_id = array_unique($emails_id);
        //        $input['receiver'] = $emails_id;
        //        $input['sender'] = 'admin@admin.com';
        //        if ($input['datetime'] != null) {
        //            $input['datetime'] = date('Y-m-d', strtotime($input['datetime']));
        //        }
        //        $validator = Validator::make($input, Mail::$cast);
        //        if ($validator->fails()) {
        //            return redirect()->route('mails.importView')->withErrors($validator)->withInput();
        //        }
        //        $input['receiver'] = json_encode($input['receiver']);
        //        Mail::create($input);
        //
        //        $details = [
        //            'message' => $input['message'],
        //            'subject' => $input['subject'],
        //            'receiver' => json_decode($input['receiver'], true)
        //        ];
        //
        //        if ($input['datetime'] == null) {
        //            $job = (new SendEmailJob($details))->delay(0);
        //        } else {
        //            $date = strtotime($input['datetime']);
        //            $job = (new SendEmailJob($details))->delay($date - Carbon::now()->addHours(2)->timestamp);
        //        }
        //        dispatch($job);

        return redirect()->route('emails.index')->with(['success' => 'Email/s ' . __("messages.add")]);
    }

    /**
     * @return Application|Factory|View
     */
    public function importView()
    {
        return view('admin.components.mail.import');
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
