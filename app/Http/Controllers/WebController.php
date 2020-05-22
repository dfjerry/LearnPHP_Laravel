<?php

namespace App\Http\Controllers;

use App\Category;
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

    //CATEGORY
    public function listCategory(){
        //query builder
        //$categories = DB::table("categories")->get();

        //Model(ORM)
        $categories = Category::all();
        //show with condition
        $categories = Category::where("category_name", "LIKE", "%")->get();
        //mỗi 1 phần tử là 1 đối tượng category
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
            Category::create([
                "category_name"=>$request ->get("category_name")
            ]);//return an Object of Category Model - trả về 1 đối tượng của category model,2 trường thời gian sẽ tự động
//            DB::table("categories")->insert([//bảng categories
//                "category_name"=>$request->get("category_name"),//category_name thứ 1 là tên cột trong categories, $request->get(category_name) cái này là name ở input
//                "created_at"=> Carbon::now(),//Carbon now lấy time hiện tại
//                "updated_at"=> Carbon::now()
//            ]);
        }catch (\Exception $exception){
            return redirect()->back();//back() trở lại trang trước, ở đây là trang form
        }
        //dd($request->all());
        //lấy tất cả dữ liệu ng dùng gửi lên ở body in ra
        return redirect()->to("/list-category");
    }
    public function editCategory($id){
//        $category = Category::find($id);
//        if(is_null($category))
//            abort(404);//neu category = null trả về trang 404, dòng 73 74 75 code = dòng 76, thường dùng cách thứ 2
        $category = Category::findOrFail($id);//find tra ve 1 doi tuong co id la id truyen vao, orFail tra ve fail neu ko co
        return view("category.edit", ["category"=>$category]);
    }
    public function updateCategory($id, Request $request){
        //tra ve id
        $category = Category::findOrFail($id);//lấy giá trị category theo giá trị đã sửa
        //validate
        $request->validate([
           "category_name"=> "required|min:2|unique:categories,category_name,($id)"//truyền vào giá trị id muốn loại trừ để giống đc chứ ko unique
        ]);
        //sau khi lấy được giá trị update mới và qua khâu validator thì update vào DB, update xong redirect về list, nếu ko đc thì back lại
        try {
            $category->update([
                "category_name"=> $request->get("category_name")
            ]);
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-category");
    }
    public function deleteCategory($id){
        $category = Category::findOrFail($id);//lấy category được truyền vào id lấy từ param
        try {
            $category->delete();//xóa category
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-category");
    }
    //BRAND
    public function listBrand(){
        $brands = DB::table("brands")->get(); //query builder
        return view('brand.list', [
            "brands"=> $brands
        ]);
    }
    public function newBrand(){
        return view("brand.new");
    }
    public function saveBrand(Request $request){
        $request->validate([
            "brand_name"=>"required|string|min:2|unique:brands"
        ]);
        try {
            DB::table("brands")->insert([//bảng categories
                "brand_name"=>$request->get("brand_name"),//category_name thứ 1 là tên cột trong categories, $request->get(category_name) cái này là name ở input
                "created_at"=> Carbon::now(),//Carbon now lấy time hiện tại
                "updated_at"=> Carbon::now()
            ]);
        }catch (\Exception $exception){
            return redirect()->back();//back() trở lại trang trước, ở đây là trang form
        }
        //dd($request->all());
        //lấy tất cả dữ liệu ng dùng gửi lên ở body in ra
        return redirect()->to("/list-brand");
    }

}
