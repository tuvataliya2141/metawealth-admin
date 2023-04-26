<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailSender;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($details) {        
        Mail::to($details['user']['email'])->send(new MailSender($details));        
        return true;
    }
}
