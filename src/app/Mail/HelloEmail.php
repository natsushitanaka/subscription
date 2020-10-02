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
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $user, $view)
    {
        $this->customer = $customer;
        $this->user = $user;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/'.$this->view)
                        ->subject('From：' . $this->user->name)
                        ->with('customer', $this->customer)
                        ->with('user', $this->user);
    }
}
