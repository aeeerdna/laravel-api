<?php

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

Route::get('/', function(){
    return view("guest.home");
})->name('index');

Route::get('/', function () {
    return view('guest.home');
})->name('index');


// admin routes
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('index');
        Route::resource('posts','PostController');
    });


Route::get("{any?}", function(){
    return redirect()->route('index');
    return view("guest.home");
})->where("any", ".*");
