<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Psy\Util\Str;

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
        $categories = Category::all();
        $products = Product::all();
//        foreach ($products as $p){
//            $slug = \Illuminate\Support\Str::slug($p->__get("product_name"));
//            $p->slug = $slug.$p->__get("id");
//            $p->save();
//            //tương đương $p->update(["slug"=>$slug.$p->__get("id");])
//        }
        $featureds = Product::orderBy("updated_at", "DESC")->limit(8)->get();
        $latests1 = Product::orderBy("created_at", "DESC")->limit(3)->get();
        $latests2 = Product::orderBy("created_at", "DESC")->offset(3)->limit(3)->get();//offset: bỏ qua 3 thằng đầu
        return view("frontend.home", [
            "categories"=> $categories,
            "featureds"=>$featureds,
            "latests1"=>$latests1,
            "latests2"=>$latests2,
        ]);
    }
    public function category(Category $category){//router model binding
        //$products = Product::where("category_id", $category->__get("id")->paginate(12));//c1 truy vấn thẳng trong bảng product
        $products = $category->Products()->paginate(12);//cach 2 lấy quan hệ đối tượng dựa theo đối tượng
        return view("frontend.category", [
            "category"=>$category,//trả category về cho trang front end
            "products"=>$products,
            ]);
    }
    public function product(Product $product){//router model binding
        $categories = Category::all();
        $category = Category::where("category_id", $category->__get("id")->paginate(12));
        return view("frontend.product", [
            "product"=>$product
        ]);
    }
}
