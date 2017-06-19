<?php

namespace Org4Leagues\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Org4Leagues\User;

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
    public $token;

    public function __construct($name, $email, $team, $rmail)
    {
        // initialize global variables
        $this->email = $email;
        $this->name  = $name;
        $this->team  = $team;
        $this->token = \Crypt::encrypt($rmail);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome')
                    ->from('admin@org4leagues.com')
                    ->subject('Congratulations for being selected in the team '.$this->team);
    }
}
