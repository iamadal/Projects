<?php

/**
 * All public routes must be out of middleware to skip authentication
 * */


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\cUser;
use App\Http\Controllers\cAdmin;
use App\Http\Middleware\Mws;

Route::middleware(['throttle:60,1'])->group(function(){
    Route::get('/', [cUser::class, 'index'])->name('app_root');
    Route::get('/bems-login',  [cAdmin::class,'getLogin']);
    Route::get('/logout',      [cAdmin::class, 'logout'])->name('logout');

    Route::post('/bems-login', [cAdmin::class,'postLogin'])->name('app_login');
});

Route::prefix('admin')->middleware(mws::class,'throttle:60,1')->group(function () {
    Route::get('/home',      [cAdmin::class, 'home'])->name('admin_home');
    Route::get('/list',      [cAdmin::class, 'user_list'])->name('user_list');
    Route::get('/create',    [cAdmin::class, 'create_new'])->name('add');
    Route::get('/list/{id}', [cAdmin::class, 'delete']);
    Route::get('/edit/{id}', [cAdmin::class, 'edit'])->name('edit');

    Route::post('/edit/{id}',[cAdmin::class, 'edit_save'])->name('edit_save');
    Route::post('/create',   [cAdmin::class, 'create_new_save'])->name('add_save');
});


