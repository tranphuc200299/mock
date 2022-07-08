<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkerVerifyMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $url, $token, $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $url, $token)
    {
        $this->id = $id;
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mailVerifyWorker')->with([
            'url' => $this->url,
            'id' => $this->id,
            'token' => $this->token,
        ]);
    }
}
