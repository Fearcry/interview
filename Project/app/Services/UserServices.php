<?php

namespace App\Services;

use App\Mail\forgotPasswordMail;
use App\Mail\verifyMail;
use App\Models\passwordReset;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;


class UserServices
{

    public function login($req)
    {
        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->email_verified_at == null) {
                throw new \Exception("You have not activated your membership. Please check your inbox.");
                Auth::logout();
            }
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
        Mail::to($user->email)->send(new verifyMail(['name' => $user->name, 'token' => $verifyUser->token]));
        logger("User created {$req->name} - {$req->email}");
    }
    public function update(Request $req)
    {
        logger('user updated');
    }

    public function verify($token)
    {
        $verify = VerifyUser::where('token', $token)->first();

        if (empty($token) || !isset($verify)) {
            throw new \Exception("Invalid Verify Code");
        }
        if (!empty($verify->user->email_verified_at)) {
            throw new \Exception("Invalid Verify Code");
            die();
        } else {
            $verify->user->email_verified_at = now();
            if ($verify->user->save()) {
                $verify = VerifyUser::where('token', $token)->first();
                $verify->delete();
            }
        }
    }
    public function forgotPassword($req)
    {
        $user = User::where('email', $req->email)->first();
        if (isset($user)) {
            $reset = passwordReset::create([
                'user_id'=>$user->id,
                'token' => sha1(time())
            ]);
            Mail::to($user->email)->send(new forgotPasswordMail(['name' => $user->name, 'token' => $reset->token]));
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
            $forgot->user->password = Hash::make($req->password);
            if ($forgot->user->save()) {
                $forgot = passwordReset::where('token', $req->token)->first();
                $forgot->delete();
            }
        } else {
            throw new \Exception("Invalid Reset Code");
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
    public function getUsers(){
        return User::all();
    }
    public function getUserById($id){
        return User::where('id',$id)->first();
    }
}
