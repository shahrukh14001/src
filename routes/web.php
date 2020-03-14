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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['prefix' => 'digital', 'middleware'   => ['auth']], function () {
    Route::resource('documents',                'Web\DocumentController');
    Route::resource('users',                     'Web\UserController');
    Route::resource('profiles',                   'Web\Profile\ProfileController');
});

Route::get('documents/list',               'Web\Documents\DocumentListController@index')->name('documents.list');
Route::get('users/list',               'Web\Users\UserListController@index')->name('users.list');