<?php

namespace TeamSnap\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use TeamSnap\User;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $body;
    public $subject;
    public $sender;
    public $name;

    public function __construct($email, $fname, $lname, $sub, $b)
    {
        // initialize global variables
        $this->sender = $email;
        $this->name = $fname.' '.$lname;
        $this->subject = $sub;
        $this->body = $b;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.mymail')
                    ->from($this->sender, $this->name)
                    ->subject($this->subject);
    }
}
