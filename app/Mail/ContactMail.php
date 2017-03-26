<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    private $msg=[];
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$msg)
    {
      $this->msg=[$name,$email,$msg];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('emails.contact')
      ->with('cont',[$this->msg[0],$this->msg[1],$this->msg[2]]);
    }
}

