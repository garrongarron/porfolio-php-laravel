<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMailing extends Mailable
{
    public $title;  
    use Queueable, SerializesModels;
    public function __construct($title)
    {
        $this->title = $title;
    }
    public function build()
    {
        return $this->view('mail.testmailing');//check it out
    }
}