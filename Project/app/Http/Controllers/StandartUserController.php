<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StandartUserController extends Controller
{
    protected $redirectTo = '/';
    public function login(Request $req, UserServices $userServices)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        //LOGIN USER
        try {
            $userServices->login($req);
            return back()
                ->with(
                    'success',
                    'Successfully logged in. You are redirected to the homepage.'
                );
        } catch (\Exception $ex) {

            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->withInput($req->all());
        }
    }
    public function logout(UserServices $userServices)
    {
        $userServices->logout();
        return redirect()->route('home');
    }
    public function create(Request $req, UserServices $userServices) //CREATE USER
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }

        try {
            $userServices->create($req);
            return back()
                ->with(
                    'success',
                    'You have successfully registered.
             Please activate your membership with the verification
             link we send to your e-mail address.'
                );
        } catch (\Exception $ex) {
            return back()
                ->withErrors(['create' => $ex->getMessage()])
                ->withInput($req->all());
        }
    }
    public function changePassword(Request $req, UserServices $userServices) //Authorized User Password Change
    {
        $validator = Validator::make($req->all(), [
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            //Change Password Authorized User
            $userServices->changePassword($req);
            toastr()->success('Password Changed.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage(), 'Error');
            return back();
        }
    }
    public function forgotPassword(Request $req, UserServices $userServices) //Send Mail Forgot Password
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            $userServices->forgotPassword($req);
            return back()
                ->with(
                    'success',
                    'Password change request has been sent. Please check your inbox.'
                );
        } catch (\Exception $ex) {
            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->withInput($req->all());
        }
    }
    public function resetForgotPassword(Request $req, UserServices $userServices) //  Forgot Password Change
    {
        $validator = Validator::make($req->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            $userServices->forgotPasswordChange($req);
            return back()
                ->with(
                    'success',
                    'Your password has been changed successfully.'
                );
        } catch (\Exception $ex) {
            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->withInput($req->all());
        }
    }
    public function verify($token, UserServices $userServices)
    {
        try {
            if (!session()->has('success')) {
                $userServices->verify($token);
            }
            return view('frontend.pages.auth.verify', [
                'success' => '
                Your membership has been activated.
                 You are redirected to the login page.'
            ]);
        } catch (\Exception $ex) {
            return view('frontend.pages.auth.verify', ['error' => $ex->getMessage()]);
        }
    }
    public function resendVerify(UserServices $userServices)
    {
        try {
            $userServices->resendVerifyCode();
            return back()
                ->with(
                    'success',
                    'The activation code has been sent again. Please check your inbox.'
                );
        } catch (\Exception $ex) {
            return back()
                ->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
