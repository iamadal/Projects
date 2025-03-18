<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/',            function () {  return view('index'); })->name('app_root');
Route::get('/create',       [UserController::class, 'create'])->name('users.create');
Route::get('/password_reset',[UserController::class,'password_reset'])->name('users.password_reset');

Route::post('/login', [Users::class, 'login'] )->name('app_login');
Route::post('/register', [UserController::class, 'register'])->name('users.register');
Route::post('/password_reset',[UserController::class,'password_reset_post']);




/*  users*/
Route::prefix('users')->group(function () {
    Route::get('/home',   function ()   { return 'User Home';});
    Route::get('/mytask',    function () {    return 'List of users';});
    Route::get('/submitted', function () {  return 'User Submitted';});
    Route::get('/payment', function () {    return 'User Payment';});
    Route::get('/profile', function () { return 'User Profile';});
});

/*  admin */

