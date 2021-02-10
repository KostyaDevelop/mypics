<?php

use Illuminate\Support\Facades\Route;

//Авторизация, регистрация
Auth::routes();

//Главная страница
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\MainController::class, 'index'])->name('home');

//Страница пользователя
Route::get('/id{id}', [App\Http\Controllers\PeopleController::class, 'index'])->name('people');
//Фотографии на странице пользователя
Route::post('/add_photo{id}', [App\Http\Controllers\PeopleController::class, 'addPhoto'])->name('add_photo');
Route::post('/delete_photo/{id}/{photo_name}', [App\Http\Controllers\PeopleController::class, 'deletePhoto'])->name('delete_photo');
//Аватар на странице пользователя
Route::post('/add_avatar{id}', [App\Http\Controllers\PeopleController::class, 'addAvatar'])->name('add_avatar');
Route::post('/delete_avatar/{id}/{avatar_name}', [App\Http\Controllers\PeopleController::class, 'deleteAvatar'])->name('delete_avatar');
//Комментарии на фотографиях
Route::post('/take_comment{id}', [App\Http\Controllers\PeopleController::class, 'takeComment'])->name('take_comment');



