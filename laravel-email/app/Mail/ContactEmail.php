<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $messageContact;
    private $emailContact;
    private $nameContact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameContact, $emailContact, $messageContact)
    {
        $this->nameContact = $nameContact;
        $this->emailContact = $emailContact;
        $this->messageContact = $messageContact;
        $this->replyTo($emailContact, $nameContact);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('contactemail', ["nameContact" => $this->nameContact, "emailContact" => $this->emailContact, "messageContact" => $this->messageContact]);
    }
}
