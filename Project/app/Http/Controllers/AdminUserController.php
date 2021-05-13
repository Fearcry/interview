<?php

namespace App\Http\Controllers;

use App\Services\AdminUserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{


    public function index(AdminUserServices $adminServices)
    {
        return view('dashboard.pages.users.index', ['standart' => $adminServices->getAll(true), 'admins' => $adminServices->getAll()]);
    }
    public function loginIndex()
    {
        return view('dashboard.pages.auth.login');
    }
    public function forgotIndex()
    {
        return view('dashboard.pages.auth.forgot-password');
    }
    public function standartCreateIndex()
    {
        return view('dashboard.pages.users.create', ['admin' => false]);
    }
    public function adminCreateIndex()
    {
        return view('dashboard.pages.users.create', ['admin' => true]);
    }
    public function standartEditIndex($id, AdminUserServices $adminServices)
    {
        $user = $adminServices->getById($id, true);
        return view('dashboard.pages.users.edit', ['admin' => false, 'user' => $user]);
    }
    public function adminEditIndex($id, AdminUserServices $adminServices)
    {
        try {
            $user = $adminServices->getById($id);
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage(), 'Error');
            return back();
        }
        return view('dashboard.pages.users.edit', ['admin' => true, 'user' => $user]);
    }



    public function login(Request $req, AdminUserServices $adminServices)  //LOGIN ADMIN USER
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

        try {
            $adminServices->login($req);
            return back()
                ->with(
                    'success',
                    'Successfully logged in. You are redirected to the dashboard.'
                );
        } catch (\Exception $ex) {

            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->withInput($req->all());
        }
    }
    public function logout(AdminUserServices $adminServices) // LOGOUT ADMIN USER
    {
        $adminServices->logout();
        return redirect()->route('dashboard.login');
    }
    public function forgotPassword(Request $req, AdminUserServices $adminServices)
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
            $adminServices->forgotPassword($req);
        } catch (\Exception $ex) {
            return back()
                ->withErrors(['error' => $ex->getMessage()])
                ->withInput($req->all());
        }
    }


    public function adminCreate(Request $req, AdminUserServices $adminServices) // POST ADMIN USER CREATE
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:admins'],
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            $adminServices->create($req);
            toastr()->success('User ' . $req->email . ' Created.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
        }
    }

    public function adminEdit(Request $req, AdminUserServices $adminServices) // POST ADMIN USER EDİT
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:admins,email,' . $req->id,
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            $adminServices->update($req);
            toastr()->success('User ' . $req->email . ' Updated.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }

    public function adminEditPassword(Request $req, AdminUserServices $adminServices) // POST ADMIN USER PASSWORD EDİT
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
            $adminServices->editPassword($req);
            toastr()->success('User ' . $req->email . ' Password Changed.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }

    public function adminDelete($id, AdminUserServices $adminServices)   //POST ADMIN USER DELETE
    {
        try {
            $adminServices->delete($id);
            toastr()->success('User Removed.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }

    public function standartCreate(Request $req, AdminUserServices $adminServices) // POST STANDART USER CREATE
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
            $adminServices->create($req, true);
            toastr()->success('User ' . $req->email . ' Created.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
        }
    }

    public function standartEdit(Request $req, AdminUserServices $adminServices)  // POST STANDART USER EDİT
    {

        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users,email,' . $req->id,
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            $adminServices->update($req, true);
            toastr()->success('User ' . $req->email . ' Updated.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }
    public function standartEditPassword(Request $req, AdminUserServices $adminServices)  // POST STANDART USER PASSWORD EDİT
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
            $adminServices->editPassword($req, true);
            toastr()->success('User ' . $req->email . ' Password Changed.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }

    public function standartDelete($id, AdminUserServices $adminServices) //POST STANDART USER DELETE
    {
        try {
            $adminServices->delete($id, true);
            toastr()->success('User Removed.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }
}
