<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy("created_at", "ASC")->get();//ASC và DESC là lấy thứ tự từ trên xg và ngược lại
        $featureds = Product::orderBy("updated_at", "DESC")->limit(8)->get();
        $latests1 = Product::orderBy("created_at", "DESC")->limit(3)->get();
        $latests2 = Product::orderBy("created_at", "DESC")->offset(3)->limit(3)->get();//offset: bỏ qua 3 thằng đầu
        return view("frontend.home", [
            "categories"=>$categories,
            "featureds"=>$featureds,
            "latests1"=>$latests1,
            "latests2"=>$latests2,
        ]);
    }
}
