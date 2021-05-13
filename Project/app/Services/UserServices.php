<?php

namespace App\Services;


use App\Models\passwordReset;
use App\Models\User;
use App\Models\VerifyUser;
use App\Services\MailServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Request;

class UserServices
{

    public function __construct(MailServices $mail)
    {
        $this->mail = $mail;
    }

    public function login($req)
    {
        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            redirect()->intended('home');
            logger('user success login');
            return true;
        }
        throw new \Exception("Your email or password is incorrect.");
    }
    public function create($req)
    {
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);

        $this->mail->SendVerifyAccount($user, $verifyUser->token);
        logger("User created {$req->name} - {$req->email}");
    }

    public function verify($token)
    {
        $verify = VerifyUser::where('token', $token)->first();

        if (empty($token) || !isset($verify)) {
            throw new \Exception("Invalid Verify Code");
        }
        if (!empty($verify->user->email_verified_at)) {
            throw new \Exception("Invalid Verify Code");

        } else {
            $this->verifyExpiryCheck($token);
            $verify->user->email_verified_at = now();
            if ($verify->user->save()) {
                $verify = VerifyUser::where('token', $token)->first();
                $verify->delete();
            }
        }
    }
    public function verifyExpiryCheck($token)
    {
        $verify = VerifyUser::where('token', $token)->first();
        if(!isset($verify)){
            throw new \Exception("Invalid Verify Code");
        }
        $createdDate = Carbon::parse($verify->created_at, 'Europe/Istanbul');
        $expiredDate = $createdDate->addMinutes(10);
        $now = Carbon::now('Europe/Istanbul');
        if ($now >= $expiredDate) {
            throw new \Exception("The activation code has expired.");
        }
    }

    public function resendVerifyCode()
    {
        $verify = VerifyUser::where('user_id', Auth::user()->id)->first();
        if (!isset($verify)) {
            throw new \Exception("No such user exists!");
        }
        $verify->created_at = now();
        $verify->token = sha1(time());
        $verify->save();
        $this->mail->SendVerifyAccount($verify->user, $verify->token);
    }
    public function forgotPassword($req)
    {
        $user = User::where('email', $req->email)->first();
        if (isset($user)) {
            $reset = passwordReset::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $this->mail->SendForgotPassword($user, $reset->token);
        } else {
            throw new \Exception("No such user exists");
        }
    }

    public function forgotPasswordChange($req)
    {
        if (empty($req->token)) {
            throw new \Exception("Invalid Reset Code");
        }

        $forgot = passwordReset::where('token', $req->token)->first();
        if (isset($forgot)) {
            $this->forgotExpiryCheck($req->token);
            $forgot->user->password = Hash::make($req->password);
            if ($forgot->user->save()) {
                $forgot = passwordReset::where('token', $req->token)->first();
                $forgot->delete();
            }
        } else {
            throw new \Exception("Invalid Reset Code");
        }
    }
    public function forgotExpiryCheck($token)
    {
        $reset = passwordReset::where('token', $token)->first();
        if(!isset($reset)){
            throw new \Exception("Invalid Reset Code");
        }
        $createdDate = Carbon::parse($reset->created_at, 'Europe/Istanbul');
        $expiredDate = $createdDate->addMinutes(10);
        $now = Carbon::now('Europe/Istanbul');
        if ($now >= $expiredDate) {
            throw new \Exception("The reset code has expired.");
        }
    }
    public function changePassword($req)
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = Hash::make($req->password);
            $user->save();
            logger('user changed password');
        } else {
            throw new \Exception("You are not authorized to perform this operation.");
        }
    }
    public function logout()
    {
        if (Auth::check()) {
            $user = Auth::user();
            logger("logout {$user->name} - {$user->email}");
            toastr()->success('Success', 'Logout');
            Auth::logout();
        }
    }
    public function updateLastLogin()
    {
        $now = now();
        logger("lastLogin {$now}");
    }
    public function getUsers()
    {
        return User::all();
    }
    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }
}
