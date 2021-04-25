<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PointsSystem;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details =[
            'title' => 'Mail from Icrew-Covid 19 Resource Tracker',
            'body' => 'Your first point as a volunteer. We salute your efforts in such testing times'
        ];

        Mail::to("dhruvpbhatt2902@gmail.com")->send(new PointsSystem($details));
        return "Email Sent";
    }
}
