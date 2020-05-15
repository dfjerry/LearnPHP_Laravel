<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function demoRouting(){
        return view("demo");// tra ve file demo.blade.php, nhung chi can viet demo
    }
    public function login(){
        return view("login");
    }
    public function register(){
        return view("register");
    }
    public function forgot(){
        return view("forgot");
    }

}
