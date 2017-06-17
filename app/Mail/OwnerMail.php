<?php

namespace TeamSnap\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OwnerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $firstname;
    public $lastname;
    public $receiver;
    public $sub;
    public $pass;

    public function __construct($firstname, $lastname, $receiver, $sub, $pass)
    {
        // initialize global variables
        $this->receiver   = $receiver;
        $this->firstname  = $firstname;
        $this->lastname   = $lastname;
        $this->sub        = $sub;
        $this->pass       = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.owner')
                    ->from('admin@org4leagues.com')
                    ->subject($this->sub);
    }
}
