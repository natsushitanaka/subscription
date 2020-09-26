<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $email_view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $email_view)
    {
        $this->data = $data;
        $this->email_view = $email_view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/'.$this->email_view)
                        ->subject('[Notification From GAO]')
                        // ->from('Kitchen GAO')
                        ->with('data', $this->data);
    }
}
