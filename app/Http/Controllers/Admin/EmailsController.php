<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EmailsDataTable;
use App\Http\Controllers\Controller;
use App\Imports\EmailsImport;
use App\Models\Category;
use App\Models\Email;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param EmailsDataTable $emailsDataTable
     * @return Application|Factory|View
     */
    public function index(EmailsDataTable $emailsDataTable)
    {
        return $emailsDataTable->render('admin.components.email.datatable');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $email = new Email();
        $categories = Category::pluck("name", "id");
        $selectedCategories = [];
        return view('admin.components.email.create', compact('email', 'categories', 'selectedCategories'));
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
        $validator = Validator::make($input, Email::$cast);
        if ($validator->fails()) {
            return redirect()->route('emails.create')->withErrors($validator)->withInput();
        }
        $email = Email::create($input);
        if (isset($input['category_id'])) {
            $categories = Category::find($input['category_id']);
            $email->categories()->attach($categories);
        }
        return redirect()->route('emails.index')->with(['success' => 'Email ' . __("messages.add")]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $email = Email::with("categories")->findorfail($id);
        $categories = Category::pluck("name", "id");
        $selectedCategories = $email->categories;
        return view('admin.components.email.edit', compact('email', 'categories', 'selectedCategories'));
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
        $input = $request->all();
        $email = Email::find($id);
        $email->update($input);
        if (isset($input['category_id'])) {
            $categories = Category::find($input['category_id']);
            $email->categories()->detach();
            $email->categories()->attach($categories);
        }
        return redirect()->route('emails.index')->with(['success' => 'Email ' . __("messages.update")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $email = Email::findOrFail($id);
        $email->delete();
        return redirect()->route('emails.index')->with(['success' => 'Email ' . __("messages.delete")]);
    }

    public function importView()
    {
        return view('admin.components.mail.import');
    }

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
        return redirect()->route('emails.index')->with(['success' => 'Email/s ' . __("messages.add")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function fetchEmails(Request $request)
    {
        $input = $request->all();
        unset($input['token']);
        $category = Category::where('name', $input['name'])->first();
        return $category->emails->pluck('email')->toArray();
    }
}
