<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SendEmail
    {
        $m = htmlspecialchars_decode($this->details['message'], ENT_HTML5);
        return $this->subject($this->details['subject'])
            ->view('admin.components.email_template.template', compact('m'));
    }
}
