<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\mws;
use App\Http\Middleware\admin_mws;

/*  admin */
  
Route::get('/',               function () {  return view('index'); })->name('app_root');
Route::get('/login',          function()  {  return view('login'); })->name('app_login_view');
Route::get('/create',         [UserController::class, 'create'])->name('users.create');
Route::get('/password_reset', [UserController::class,'password_reset'])->name('users.password_reset');
Route::get('/logout',         [UserController::class,'logout'])->name('app_logout');

Route::post('/login',         [UserController::class, 'login'] )->name('app_login');
Route::post('/register',      [UserController::class, 'register'])->name('users.register');
Route::post('/password_reset',[UserController::class,'password_reset_post']);


/*  users*/
Route::prefix('users')->middleware([mws::class,'throttle:60,1'])->group(function () {
    Route::get('/home', [UserController::class, 'userHome'])->name('dashboard');
    Route::get('/mytask', function () { return 'List of users'; });
    Route::get('/submitted', function () { return 'User Submitted'; });
    Route::get('/payment', function () { return 'User Payment'; });
    Route::get('/profile', function () { return 'User Profile'; });
});

/* admin panel */
Route::get('admin/login',[AdminController::class, 'admin_login'])->name('admin_login'); // This should be out of middleware to skip the looping
 Route::post('admin/login', [AdminController::class, 'admin_login_submit'])->name('admin_login_submit');

Route::prefix('admin')->middleware([admin_mws::class,'throttle:60,1'])->group(function () {
    Route::get('/home', [AdminController::class, 'admin_home'])->name('admin_home');
});

