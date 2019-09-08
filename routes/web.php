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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user-list'], function() {
    Route::get('/add', 'UserList\AddController@showAddForm')->name('userList.showAddForm');
    Route::post('/add', 'UserList\AddController@add')->name('userList.add');
});
