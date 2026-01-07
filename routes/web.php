<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/users',[UsersController::class,'index'])->name('users.index');
//Route::get('users/{id}',[UsersController::class,'show'])->name('users.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('users', UsersController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
