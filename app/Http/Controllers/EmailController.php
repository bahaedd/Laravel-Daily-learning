<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function create()
    {
        return view('emails.create');

    }

    public function send() {

      $data =  request()->validate([
            'email' => 'email|required',
            'name'  => 'required',
            'message' => 'required'
        ]);


        // $to_name = request('name');
        // $to_email = request('email');
        // $to_message = request('email');
        // $data = array('name'=>'bahaeddine', 'body' => $to_message);
        // Mail::send('emails.welcome', $data, function($message) use ($to_name, $to_email) {
        // $message->to($to_email, $to_name)
        // ->subject('Laravel Test Mail');
        // $message->from(env('MAIL_USERNAME'),'Test Mail');
        // });

        $details = [
            'title' => 'Mail from bahaeddine',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to(request('email'))->send(new \App\Mail\EmailTest($details));
    }
}
