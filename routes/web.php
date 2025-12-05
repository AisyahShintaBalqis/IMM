<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ROUTE UNTUK HALAMAN ADMIN
Route::get('/backend', function () {
    return view('backend.master');
});
