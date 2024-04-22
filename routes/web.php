<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@doLogin')->name('doLogin');

Route::get('/', 'App\Http\Controllers\TicketController@create')->name('home')->middleware('auth');
Route::get('/dashboard', 'App\Http\Controllers\TicketController@dashboard')->name('dashboard')->middleware('auth');

// Group of Tickets
Route::group(['prefix' => 'tickets', 'middleware' => 'auth'], function() {
    Route::get('/', 'App\Http\Controllers\TicketController@index')->name('tickets.index');
    Route::get('/create', 'App\Http\Controllers\TicketController@create');
    Route::post('/store', 'App\Http\Controllers\TicketController@store')->name('tickets.store');
    Route::get('/{id}', 'App\Http\Controllers\TicketController@show')->name('tickets.show');
    Route::get('/{id}/edit', 'App\Http\Controllers\TicketController@edit');
    Route::put('/{id}', 'App\Http\Controllers\TicketController@update')->name('tickets.update');
    Route::delete('/{id}', 'App\Http\Controllers\TicketController@destroy');
});


Route::group(['prefix' => 'users', 'middleware' => 'auth'], function() {
    Route::get('/', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/create', 'App\Http\Controllers\UserController@create')->name('users.create');
    Route::post('/store', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::get('/{id}', 'App\Http\Controllers\UserController@show');
    Route::get('/{id}/edit', 'App\Http\Controllers\UserController@edit');
    Route::put('/{id}', 'App\Http\Controllers\UserController@update');
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy');
});

Route::get('/forgot-password', 'App\Http\Controllers\UserController@forgotPassword')->name('forgot-password');
Route::post('/forgot-password', 'App\Http\Controllers\UserController@sendForgotPassword')->name('password.email');

Route::get('/reset-password/{token}', 'App\Http\Controllers\UserController@resetPassword')->name('password.reset');
Route::get('/token/{token}', 'App\Http\Controllers\Usercontroller@token')->name('token');
Route::post('/proccess/token/{token}', 'App\Http\Controllers\UserController@proccessToken')->name('process.token');