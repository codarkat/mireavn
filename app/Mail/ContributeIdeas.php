<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContributeIdeas extends Mailable
{
    use Queueable, SerializesModels;
    public $ideas;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $ideas)
    {
        $this->email = $email;
        $this->ideas = $ideas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('WEB - Đóng góp ý tưởng')->markdown('emails.contribute-ideas');
    }
}
