<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\MailsController;
use App\Models\Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return bool
     */
    public function handle(): bool
    {
        $mails = Mail::where("is_sent", "0")->where("sent_time", "<=", Carbon::now())->get();
        if ($mails->count()) {
            foreach ($mails as $mail) {
                try {
                    $emails = json_decode($mail['receiver'], true);
                    foreach (array_chunk($emails, 10) as $key => $part_emails) {
                        $details = [
                            'message' => $mail['message'],
                            'subject' => $mail['subject'],
                            'receiver' => $part_emails
                        ];
                        foreach ($part_emails as $email) {
                            $mailController = new MailsController();
                            $mailController->composeEmail($email, $details['subject'], $details['message']);
                        }
//                        $job = (new SendEmailJob($details))->delay(Carbon::now()->addMinutes($key + 2));
//                        dispatch($job);
                    }
                    $mail->is_sent = 1;
                    $mail->save();
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
        return true;
    }
}
