<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarketingMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mailSubject;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailSubject, $body)
    {
        $this->mailSubject = $mailSubject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.marketing', [
            'subject' => $this->mailSubject,
            'body' => $this->body
        ]);
    }
}
