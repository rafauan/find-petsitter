<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryAnswerMail extends Mailable
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
        return $this->subject('FindPetsitter - opiekun odpowiedział na Twoje zapytanie')
                    ->from('contact@findpetsitter.pl')
                    ->view('emails.inquiry_answer_mail');
    }
}
