<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail(){
        $user = auth() -> user();
        Mail::to($user)->send(new MailNotify($user));
        if(Mail::failures()){
            return response()->Fail('Sorry! Please try again lateer');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }
}
