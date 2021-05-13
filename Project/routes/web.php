<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\StandartUserController;
use App\Http\Controllers\taskController;
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

Route::get('/', [frontendController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/page/{page}', [frontendController::class, 'index'])->name('home-task-paged');
    Route::get('/task/delete/{id}', [taskController::class, 'delete'])->name('get-task-delete');
    Route::post('/password/change', [StandartUserController::class, 'changePassword'])->name('post-change-password');
    Route::post('/task', [taskController::class, 'create'])->name('post-task');
});
Route::get('/login', [frontendController::class, 'login'])->name('login');
Route::get('/register', [frontendController::class, 'register'])->name('register');
Route::get('/forgot-password', [frontendController::class, 'forgot'])->name('forgot');
Route::get('/reset-password/{token}', [frontendController::class, 'resetPassword'])->name('reset-password');
Route::get('/logout', [StandartUserController::class, 'logout'])->name('logout');
Route::get('/verify/{token}', [StandartUserController::class, 'verify'])->name('verify');

/* Posts */
Route::post('/register', [StandartUserController::class, 'create'])->name('post-register');
Route::post('/login', [StandartUserController::class, 'login'])->name('post-login');
Route::post('/forgot-password', [StandartUserController::class, 'forgotPassword'])->name('post-forgot-password');
Route::post('/reset-password', [StandartUserController::class, 'resetForgotPassword'])->name('post-reset-password');




/* Dashboard */

Route::prefix('dashboard')->group(function () {

    Route::get('/login', [AdminUserController::class, 'loginIndex'])->name('dashboard.login');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('dashboard');
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
    });

    Route::post('/login', [AdminUserController::class, 'login'])->name('post-dashboard.login');

});
