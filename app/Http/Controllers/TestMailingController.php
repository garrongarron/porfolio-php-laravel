<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMailing;

class TestMailingController extends Controller
{
    public function form(Request $request)
    {
        return view('mail.form');
    }

    public function send(Request $request)
    {
        Mail::to($request->mail)->send(new TestMailing($request->title));
        return view('mail.confirm');
    }
    
}