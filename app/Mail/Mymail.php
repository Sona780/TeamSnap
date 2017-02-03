<?php

namespace TeamSnap\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mymail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$body)
    {
        $this->title = $title;
        $this->body  = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('myapp@teamsnap.dev')
        ->view('email.mymail');
    }
}
