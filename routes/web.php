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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Controller@home')->name('login');

Route::post('/registerUser', 'Controller@registerUser');

Route::post('/loginUser', 'Controller@loginUser');

Route::get('/userHome', 'Controller@userHome')->name('userHome');

Route::get('/userLogout', 'Controller@userLogout')->name('userLogout');

Route::middleware(['auth'])->group(function () {

   	Route::get('/getUserNames', 'Controller@getUserNames')->name('getUserNames');

	Route::post('/userSearchFriend', 'Controller@userSearchFriend')->name('userSearchFriend');

	Route::get('/viewProfile/{id}', 'Controller@viewProfile')->name('viewProfile');

	Route::post('/sendFriendRequest', 'Controller@sendFriendRequest')->name('sendFriendRequest');

	Route::post('/acceptFriendRequest', 'Controller@acceptFriendRequest')->name('acceptFriendRequest');

	Route::post('/rejectFriendRequest', 'Controller@rejectFriendRequest')->name('rejectFriendRequest');

	Route::get('/myFriends', 'Controller@myFriends')->name('myFriends'); 
});


