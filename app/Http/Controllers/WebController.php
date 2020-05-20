<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index(){
        return view("home");
    }
    public function listCategory(){
        $categories = DB::table("categories")->get(); //query builder
        //dd($categories);//giong vardum
        //return co 2 tham so, 1 la link dan tuyet doi, 2 là mảng gửi dữ liệu sang bên kia
        return view('category.list', [
            "categories"=> $categories
        ]);//ten folder.tenfile
        //return ve 1 ket qua dang string
        //mảng này đóng gói $categories đc trả về từ connection rồi sau đó đóng gói chuyển sang thằng category.list dưới tên "categories"
    }
    public function newCategory(){
        return view("category.new");
    }
    public function saveCategory(Request $request){//biến $request là dữ liệu người dùng gửi lên ở body
        //phải validate dữ liệu cả html và bên server
        $request->validate([
            "category_name"=>"required|string|min:2|unique:categories"//category_name là name của input
        ]);
        //phải là kiểu string tối thiểu 6 kí tự, unique không trùng categories bảng
        //khi dữ liệu qua đc validate thì thêm vào db
        try {
            DB::table("categories")->insert([//bảng categories
                "category_name"=>$request->get("category_name"),//category_name thứ 1 là tên cột trong categories, $request->get(category_name) cái này là name ở input
                "created_at"=> Carbon::now(),//Carbon now lấy time hiện tại
                "updated_at"=> Carbon::now()
            ]);
        }catch (\Exception $exception){
            return redirect()->back();//back() trở lại trang trước, ở đây là trang form
        }
        //dd($request->all());
        //lấy tất cả dữ liệu ng dùng gửi lên ở body in ra
        return redirect()->to("/list-category");
    }
}
