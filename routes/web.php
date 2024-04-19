<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'App\Http\Controllers\AuthController@index');
Route::post('/login', 'App\Http\Controllers\AuthController@doLogin')->name('doLogin');

Route::get('/', 'App\Http\Controllers\TicketController@create');
Route::get('/dashboard', 'App\Http\Controllers\TicketController@dashboard')->name('dashboard');

// Group of Tickets
Route::group(['prefix' => 'tickets'], function() {
    Route::get('/', 'App\Http\Controllers\TicketController@index')->name('tickets.index');
    Route::get('/create', 'App\Http\Controllers\TicketController@create');
    Route::post('/store', 'App\Http\Controllers\TicketController@store')->name('tickets.store');
    Route::get('/{id}', 'App\Http\Controllers\TicketController@show');
    Route::get('/{id}/edit', 'App\Http\Controllers\TicketController@edit');
    Route::put('/{id}', 'App\Http\Controllers\TicketController@update');
    Route::delete('/{id}', 'App\Http\Controllers\TicketController@destroy');
});


Route::group(['prefix' => 'users'], function() {
    Route::get('/', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/create', 'App\Http\Controllers\UserController@create');
    Route::post('/store', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::get('/{id}', 'App\Http\Controllers\UserController@show');
    Route::get('/{id}/edit', 'App\Http\Controllers\UserController@edit');
    Route::put('/{id}', 'App\Http\Controllers\UserController@update');
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy');
});


Route::get('/token/{token}', 'App\Http\Controllers\Usercontroller@token')->name('token');
Route::post('/proccess/token/{token}', 'App\Http\Controllers\UserController@proccesToken');