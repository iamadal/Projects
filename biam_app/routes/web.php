<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pages;
use App\Http\Controllers\CAuth;


# Base Login System

Route::get('/' ,          [CAuth::class,'ViewForm'])->name('LoginForm');
Route::get('/logout',     [CAuth::class,'logout'])->name('logout');
Route::get('/app',        [Pages::class,'dashboard'])->name('dashboard');

Route::post('/',	      [CAuth::class,'SubmitForm'])->name('SubmitForm'); // Submit the login form













