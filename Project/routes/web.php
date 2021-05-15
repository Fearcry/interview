<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\StandartUserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Pages */

Route::middleware(['checkVerify'])->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
});
Route::middleware(['auth.standart'])->group(function () {
    Route::get('/unverified', [FrontendController::class, 'unverified'])->name('unverified');
    Route::get('/logout', [StandartUserController::class, 'logout'])->name('logout');
});
Route::get('/unverified', [FrontendController::class, 'unverified'])->name('unverified');
Route::middleware(['auth.standart', 'checkVerify'])->group(function () {
    Route::get('/page/{page}', [FrontendController::class, 'index'])->name('home-task-paged');
    Route::get('/task/delete/{id}', [TaskController::class, 'delete'])->name('get-task-delete');
    Route::post('/password/change', [StandartUserController::class, 'changePassword'])->name('post-change-password');
    Route::post('/task', [TaskController::class, 'create'])->name('post-task');

});
Route::middleware(['auth.guest'])->group(function () {
    Route::get('/login', [FrontendController::class, 'login'])->name('login');
    Route::get('/register', [FrontendController::class, 'register'])->name('register');
    Route::get('/forgot-password', [FrontendController::class, 'forgot'])->name('forgot');
    Route::get('/reset-password/{token}', [FrontendController::class, 'resetPassword'])->name('reset-password');

    Route::get('/verify/{token}', [StandartUserController::class, 'verify'])->name('verify');
    Route::post('/verify', [StandartUserController::class, 'resendVerify'])->name('post-unverified');
    /* Posts */
    Route::post('/register', [StandartUserController::class, 'create'])->name('post-register');
    Route::post('/login', [StandartUserController::class, 'login'])->name('post-login');
    Route::post('/forgot-password', [StandartUserController::class, 'forgotPassword'])->name('post-forgot-password');
    Route::post('/reset-password', [StandartUserController::class, 'resetForgotPassword'])->name('post-reset-password');
});




/* Dashboard */

Route::prefix('dashboard')->group(function () {

    Route::get('/login', [AdminUserController::class, 'loginIndex'])->name('dashboard.login');
    Route::get('/forgot-password', [AdminUserController::class, 'forgotIndex'])->name('dashboard.forgot');
    Route::get('/reset-password/{token}', [AdminUserController::class, 'resetPasswordIndex'])->name('dashboard.reset-password');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminUserController::class, 'logout'])->name('dashboard.logout');
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('dashboard.users');
            Route::get('/standart/edit/{id}', [AdminUserController::class, 'standartEditIndex'])->name('dashboard.users.standart.edit');
            Route::get('/standart/create', [AdminUserController::class, 'standartCreateIndex'])->name('dashboard.users.standart.create');
            Route::get('/admin/edit/{id}', [AdminUserController::class, 'adminEditIndex'])->name('dashboard.users.admin.edit');
            Route::get('/admin/create', [AdminUserController::class, 'adminCreateIndex'])->name('dashboard.users.admin.create');

            //** USER POSTS */

            Route::post('/standart/create', [AdminUserController::class, 'standartCreate'])->name('post-dashboard.user.create.standart');
            Route::post('/standart/edit', [AdminUserController::class, 'standartEdit'])->name('post-dashboard.user.edit.standart');
            Route::post('/standart/edit/password', [AdminUserController::class, 'standartEditPassword'])->name('post-dashboard.user.password.standart');
            Route::get('/standart/delete/{id}', [AdminUserController::class, 'standartDelete'])->name('get-dashboard.user.delete.standart');

            Route::post('/admin/create', [AdminUserController::class, 'adminCreate'])->name('post-dashboard.user.create.admin');
            Route::post('/admin/edit', [AdminUserController::class, 'adminEdit'])->name('post-dashboard.user.edit.admin');
            Route::post('/admin/edit/password', [AdminUserController::class, 'adminEditPassword'])->name('post-dashboard.user.password.admin');
            Route::get('/admin/delete/{id}', [AdminUserController::class, 'adminDelete'])->name('get-dashboard.user.delete.admin');
        });
        Route::prefix('countries')->group(function () {
            Route::get('/', [CountryController::class, 'index'])->name('dashboard.countries');
            Route::get('/edit/{id}', [CountryController::class, 'editIndex'])->name('dashboard.countries.edit');

            Route::post('/create', [CountryController::class, 'postCreate'])->name('post-dashboard.countries.create');
            Route::post('/edit', [CountryController::class, 'postEdit'])->name('post-dashboard.countries.edit');
            Route::get('/delete/{id}', [CountryController::class, 'delete'])->name('post-dashboard.countries.delete');
        });
        Route::prefix('cities')->group(function () {
            Route::get('/{id}', [CityController::class, 'index'])->name('dashboard.cities');
            Route::get('/edit/{id}', [CityController::class, 'editIndex'])->name('dashboard.cities.edit');
            Route::post('/create', [CityController::class, 'postCreate'])->name('post-dashboard.cities.create');
            Route::post('/edit', [CityController::class, 'postEdit'])->name('post-dashboard.cities.edit');
            Route::get('/delete/{id}', [CityController::class, 'delete'])->name('dashboard.cities.delete');
        });
    });

    Route::post('/login', [AdminUserController::class, 'login'])->name('post-dashboard.login');
    Route::post('/forgot-password', [AdminUserController::class, 'forgotPassword'])->name('post-dashboard.forgot');
    Route::post('/reset-password', [AdminUserController::class, 'resetPassword'])->name('post-dashboard.reset-password');
});
