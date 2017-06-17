<?php

namespace TeamSnap\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Manager extends Mailable
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
    public $type;

    public function __construct($name, $email, $team, $rmail, $type)
    {
        // initialize global variables
        $this->email = $email;
        $this->name  = $name;
        $this->team  = $team;
        $this->type  = $type;
        $this->token = \Crypt::encrypt($rmail);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.manager')
                    ->from('admin@org4leagues.com')
                    ->subject('Congratulations for becoming the manager of the '.$this->type.' '.$this->team);
    }
}
