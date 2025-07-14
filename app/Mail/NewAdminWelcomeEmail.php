<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAdminWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($adminData)
    {
        $this->adminData = $adminData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Linkuss Admin Panel')
            ->view('admin.new-admin-email');
    }
}