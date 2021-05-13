<?php

namespace App\Http\Controllers;


use App\Services\TaskServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class frontendController extends Controller
{
    public function index(UserServices $userServices, TaskServices $tasks, $page = 1)
    {
        if (Auth::check()) {
            $perPage = 3;
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
            $allTask = $tasks->getTasks()->paginate($perPage);
            $allTask->totalPage = (int)ceil($allTask->total() / $perPage) == 0 ? 1 : (int)ceil($allTask->total() / $perPage);

            if ($page > $allTask->totalPage && $allTask->totalPage != 0) {
                abort(404);
            }

            return view('frontend.pages.home', ['tasks' => $allTask]);
        } else {
            return view('frontend.pages.home');
        }
    }
    public function login()
    {
        return view('frontend.pages.auth.login');
    }
    public function register()
    {
        return view('frontend.pages.auth.register');
    }
    public function forgot()
    {
        return view('frontend.pages.auth.forgot-password');
    }
    public function resetPassword($token)
    {
        return view('frontend.pages.auth.reset-password', ['token' => $token]);
    }





}
