<?php

namespace App\Services;

use App\Mail\forgotAdminPasswordMail;
use App\Mail\forgotPasswordMail;
use App\Mail\verifyMail;

use Illuminate\Support\Facades\Mail;

class MailServices
{
    public function SendVerifyAccount($user,$token){
        Mail::to($user->email)->send(new verifyMail(['name' => $user->name, 'token' => $token]));
    }

    public function SendForgotPassword($user,$token)
    {
        Mail::to($user->email)->send(new forgotPasswordMail(['name' => $user->name, 'token' => $token]));
    }
    public function SendAdminForgotPassword($user,$token)
    {
        Mail::to($user->email)->send(new forgotAdminPasswordMail(['name' => $user->name, 'token' => $token]));
    }
}
