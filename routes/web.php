<?php

use App\User;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/message/store', 'MessageController@store')->name('message.store');

Route::get('/u/{user}', 'ProfileController@index')->name('profile');
Route::post('/u/follow/', 'ProfileController@follow')->name('profile.flow');
Route::get('/x', function () {
    //$user = auth()->user;
    auth()->user()->notify(new NewFollower(
        User::find(2)
    ));
});
