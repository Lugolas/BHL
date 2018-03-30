<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/formEmail', 'HomeController@formEmail');

Route::get('/profile', 'ProfileController@openProfile');

Route::resources([
    'avatars' => 'AvatarsController'
]);
//  avatars/email -> show
Route::get('/listAvatars/{email}','AvatarsController@index')->name('listAvatars.index');

Route::get('/deleteForm', 'HomeController@deleteForm');

Route::delete('/deletedForm', 'AvatarsController@deleteAvatar')->name('deleteAvatar');