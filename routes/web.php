<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/activation/{code}', 'ActivationController@activation')->name('user.activate');

Route::get('/resend/code', 'ActivationController@codeResend')->name('code.resent');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
