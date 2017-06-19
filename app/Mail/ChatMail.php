<?php

namespace Org4Leagues\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChatMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $email;
    public $sub;
    public $body;

    public function __construct($name, $email, $sub, $body)
    {
        //
        $this->name  = $name;
        $this->email = $email;
        $this->sub   = $sub;
        $this->body  = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.chat')
                    ->from($this->email, $this->name)
                    ->subject($this->sub);
    }
}
