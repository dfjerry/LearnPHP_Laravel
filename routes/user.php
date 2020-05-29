<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/demo-routing', "WebController@demoRouting");//goi sang controller, action chính là function trong controller
//Route::get('/login', 'WebController@login');
//Route::get('/register', 'WebController@register');
//Route::get('/forgot', 'WebController@forgot');

