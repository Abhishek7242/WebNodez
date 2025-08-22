<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminCustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $contentText;
    public $fromAddress;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjectText, $contentText, $fromAddress)
    {
        $this->subjectText = $subjectText;
        $this->contentText = $contentText;
        $this->fromAddress = $fromAddress;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromAddress, 'Linkuss')
            ->subject($this->subjectText)
            ->view('emails.admin-custom-mail');
    }
}
