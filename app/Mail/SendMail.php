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

    public $name;
    public $email;
    public $team;

    public function __construct($name, $email, $team)
    {
        // initialize global variables
        $this->email = $email;
        $this->name  = $name;
        $this->team  = $team;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome');
                    /*->from($this->sender, $this->name)
                    ->subject($this->subject);*/
    }
}
