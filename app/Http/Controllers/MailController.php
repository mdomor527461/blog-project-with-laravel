<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendDemoMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = [
            'title' => 'Hello from Oreeedo',
            'body' => 'This is a test email sent from Oreeedo Blog.'
        ];

        Mail::to('md3147693@gmail.com')->send(new SendDemoMail($data));

        return "Email sent successfully!";
    }
}
