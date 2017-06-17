<?php

namespace TeamSnap\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeagueInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $league;

    public function __construct($name, $email, $league)
    {
        // initialize global variables
        $this->email = $email;
        $this->name  = $name;
        $this->league  = $league;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.league-invite')
                    ->from($this->email)
                    ->subject('Your team has been added to '.$this->league.' league.');
    }
}
