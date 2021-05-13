<?php

namespace App\Http\Controllers;

use App\Services\AdminUserServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class dashboardController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';
    public function index()
    {
        return view('dashboard.pages.dashboard');
    }





}
