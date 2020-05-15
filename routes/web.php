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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo-routing', "WebController@demoRouting");//goi sang controller, action chính là function trong controller

Route::get('/login', 'WebController@login');
Route::get('/register', 'WebController@register');
Route::get('/forgot', 'WebController@forgot');
