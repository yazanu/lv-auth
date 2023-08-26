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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/', 'HomeController@home');
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');

    Route::get('/logout', 'AuthController@logout');

    Route::get('/login', 'AuthController@loginForm');
    Route::post('/login', 'AuthController@login');

    Route::resource('products', 'ProductController');
});
