<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailUserForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $url, $email, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $url)
    {
        //
        $this->url = $url;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mailForgotPassowrd')->with([
            'url' => $this->url,
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }
}
