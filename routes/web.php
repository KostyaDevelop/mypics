<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::get('/id{id}', [App\Http\Controllers\PeopleController::class, 'index'])->name('people');
Route::post('/add_photo{id}', [App\Http\Controllers\PeopleController::class, 'store_photo'])->name('add_photo');
Route::post('/delete_photo/{id}/{photo_name}', [App\Http\Controllers\PeopleController::class, 'delete_photo'])->name('delete_photo');
Route::post('/add_avatar{id}', [App\Http\Controllers\PeopleController::class, 'store_avatar'])->name('add_avatar');



