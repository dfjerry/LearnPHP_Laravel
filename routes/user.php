<?php

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'WebController@index');
//laravel 6x category:slug, hieu la lay slug trong thang category
Route::get("/category/{category:slug}", "HomeController@category");//router model binding
Route::get("/product/{product:slug}", "HomeController@product");//router model binding

Route::post("/cart/add/{product}", "HomeController@addToCart");

Route::get("/shopping-cart","HomeController@shoppingCart");
Route::get("/checkout","HomeController@checkout")->middleware("auth");
Route::post("/checkout","HomeController@placeOrder")->middleware("auth");

Route::post("/search", "HomeController@search");


Route::get('mail', 'EmailController@sendEmail');
