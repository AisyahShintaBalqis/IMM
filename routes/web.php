<?php

use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ROUTE UNTUK HALAMAN ADMIN
Route::get('/backend', function () {
    return view('backend.master');
});


Route::resource('news', NewsController::class);
Route::resource('page', PageController::class);
Route::resource('member', MemberController::class);
