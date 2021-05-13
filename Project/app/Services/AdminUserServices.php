<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserServices
{
    public function login($req)
    {

        $credentials = $req->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()
                ->intended(route('dashboard'))
                ->with('status', 'You are Logged in as Admin!');
        }
        throw new \Exception("Your email or password is incorrect.");
    }
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            toastr()->success('Success', 'Logout');
        }
    }

    public function getAll($standartUser = false)
    {
        if ($standartUser) {
            return User::all();
        } else {

            return Admin::all();
        }
    }

    public function getById($id, $standartUser = false)
    {
        if ($standartUser) {
            $users = User::where('id', $id)->first();
            if (!isset($users)) {
                abort(404);
            }
            return $users;
        } else {
            $users = Admin::where('id', $id)->first();
            if (!isset($users)) {
                abort(404);
            }
            return $users;
        }
    }

    public function create($req, $standartUser = false)
    {
        $now = now();
        if ($standartUser) {

            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]);
            $user->email_verified_at = $now;
            $user->save();
        } else {
            $user = Admin::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),

            ]);
            $user->email_verified_at = $now;
            $user->save();
        }
    }
    public function delete($id, $standartUser = false)
    {
        if ($standartUser) {
            $user = User::where('id', $id)->first();
            if (!isset($user)) {
                throw new \Exception("No such user exists!");
            }
            $user->delete();
        } else {
            $user = Admin::where('id', $id)->first();
            if (!isset($user)) {
                throw new \Exception("No such user exists!");
            }
            $user->delete();
        }
    }
    public function editPassword($req, $standartUser = false)
    {
        if ($standartUser) {
            $user = User::where('id', $req->id)->first();
            if (!isset($user)) {
                throw new \Exception("No such user exists!");
            }
            $user->password = Hash::make($req->password);
            $user->save();
        } else {
            $user = Admin::where('id', $req->id)->first();
            if (!isset($user)) {
                throw new \Exception("No such user exists!");
            }
            $user->password = Hash::make($req->password);
            $user->save();
        }
    }

    public function update($req, $standartUser = false)
    {
        if ($standartUser) {
            $user = User::where('id', $req->id)->first();
            if (!isset($user)) {
                throw new \Exception("No such user exists!");
            }
            $user->name = $req->name;
            $user->email = $req->email;
            $user->save();
        } else {
            $user = Admin::where('id', $req->id)->first();
            if (!isset($user)) {
                throw new \Exception("No such user exists!");
            }
            $user->name = $req->name;
            $user->email = $req->email;
            $user->save();
        }
    }
}
