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

Route::get('/', "WebController@index");

Route::get('/demo-routing', "WebController@demoRouting");//goi sang controller, action chính là function trong controller

Route::get('/login', 'WebController@login');
Route::get('/register', 'WebController@register');
Route::get('/forgot', 'WebController@forgot');


//Category
Route::get('/list-category', 'WebController@listCategory');
Route::get('/new-category', 'WebController@newCategory');

Route::post('/save-category', 'WebController@saveCategory');
Route::get('/edit-category/{id}', 'WebController@editCategory');
Route::put('/update-category/{id}', 'WebController@updateCategory');

//Brand
Route::get('/list-brand', 'WebController@listBrand');
Route::get('/new-brand', 'WebController@newBrand');

Route::post('/save-brand', 'WebController@saveBrand');

