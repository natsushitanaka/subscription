<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $data;
    public $email_view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $user, $email_view)
    {
        $this->customer = $customer;
        $this->user = $user;
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
                        ->with('customer', $this->customer)
                        ->with('user', $this->user);
    }
}
