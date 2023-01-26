<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OpinionApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name, $user_email, $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $user_email, $url)
    {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('FindPetsitter - pojawiła się nowa opinia na Twoim profilu')
                    ->from('contact@findpetsitter.pl')
                    ->view('emails.opinion_approved_mail');
    }
}
