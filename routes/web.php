<?php

use Illuminate\Support\Facades\Route;




Route::get('/','PagesController@home' )->name('home');

Route::get('saludos/{nombre?}','PagesController@saludos')->name('saludo');


//REST
/*
Route::get('mensajes/index','MessagesController@index')->name('messages.index');

Route::get('mensajes/create','MessagesController@create')->name('messages.create');

Route::post('mensajes','MessagesController@store')->name('messages.store');

Route::get('mensajes/{id}','MessagesController@show')->name('messages.show');

Route::get('mensajes/{id}/edit','MessagesController@edit')->name('messages.edit');

Route::put('mensajes/{id}','MessagesController@update')->name('messages.update');

Route::delete('mensajes/{id}','MessagesController@destroy')->name('messages.destroy');
*/

Route::resource('mensajes','MessagesController')
->names('messages')
->parameters(['mensajes'=>'id']);

Route::resource('usuarios','UsersController');

//AUTH

Route::get('login','Auth\LoginController@showLoginForm');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login', 'Auth\LoginController@login');


Route::get('logout','Auth\LoginController@logout');

//Roles
Route::get('roles',function(){
  return \App\Role::with('user')->get();
});