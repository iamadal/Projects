<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pages;
use App\Http\Controllers\CAuth;


# Base Login System

Route::get('/' ,[CAuth::class,'ViewForm'])->name('LoginForm');
Route::post('/',[CAuth::class,'SubmitForm'])->name('SubmitForm');

Route::get('/dashboard',[Pages::class,'dashboard'])->name('dashboard');









