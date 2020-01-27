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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/', function () {

    if(Auth::check()) {
        return redirect()->route('home');
    }

    return view('welcome');
});

Route::post('message/history', ['as' => 'message.history', 'uses' => 'MessageController@getHistory']);
Route::get('message/send', ['as' => 'message.send', 'uses' => 'MessageController@send']);
Route::post('message/status', ['as' => 'message.status', 'uses' => 'MessageController@updateStatus']);

Route::middleware(['auth', 'check.user.id'])->group(function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::post('task/handle', ['as' => 'task.handle', 'uses' => 'InworkController@handle']);

});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('table-list', function () {
            return view('pages.table_list');
        })->name('table');

        Route::get('typography', function () {
            return view('pages.typography');
        })->name('typography');

        Route::get('icons', function () {
            return view('pages.icons');
        })->name('icons');

        Route::get('map', function () {
            return view('pages.map');
        })->name('map');

        Route::get('notifications', function () {
            return view('pages.notifications');
        })->name('notifications');

        Route::get('rtl-support', function () {
            return view('pages.language');
        })->name('language');

        Route::get('upgrade', function () {
            return view('pages.upgrade');
        })->name('upgrade');
    });
});

Route::middleware(['check.routes'])->group(function () {
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController');
});









