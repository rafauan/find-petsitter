<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name, $user_email, $user_id, $user_role;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $user_email, $user_id, $user_role)
    {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->user_id = $user_id;
        $this->user_role = $user_role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('FindPetsitter - nowy użytkownik zarejestrował się w systemie')
                    ->from('contact@findpetsitter.pl')
                    ->view('emails.new_user_mail');
    }
}
