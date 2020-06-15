<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Events\OrderCreated;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

        $products = Product::all();
        foreach ($products as $p){
            $slug = \Illuminate\Support\Str::slug($p->__get("product_name"));
            $p->slug = $slug.$p->__get("id");
            $p->save();
            //tương đương $p->update(["slug"=>$slug.$p->__get("id");])
        }
        $categories = Category::all();
        foreach ($categories as $p){
            $slug = \Illuminate\Support\Str::slug($p->__get("category_name"));
            $p->slug = $slug.$p->__get("id");
            $p->save();
            //tương đương $p->update(["slug"=>$slug.$p->__get("id");])
        }
        // lấy ra những sản phẩm nhiều người xem
//        $u = Auth::user();
//        $u->role = User::ADMIN_ROLE;
//        $u->save();
        if(!Cache::has("home_page")){//nếu chưa có cache, lưu những thg dưới vào cache
            $categories = Category::all();
            $most_viewer = Product::orderBy("view_count","DESC")->limit(8)->get();
            $featureds = Product::orderBy("updated_at", "DESC")->limit(8)->get();
            $latests1 = Product::orderBy("created_at", "DESC")->limit(3)->get();
            $latests2 = Product::orderBy("created_at", "DESC")->offset(3)->limit(3)->get();//offset: bỏ qua 3 thằng đầu
            $view = view("frontend.home", [
                "most_viewer"=>$most_viewer,
                "featureds"=>$featureds,
                "latests1"=>$latests1,
                "latests2"=>$latests2,
                "categories"=> $categories,
            ])->render();
            $now = Carbon::now();//lấy tương tự date/time
            Cache::put("home_page", $view, $now->addMinute(20));//set cache 20 phút
            //cache put là nạp vào, thời hạn tối đa 20p tính từ thời điểm now().

//            $cache = [
//                "most_viewer" => $most_viewer,
//                "featureds"=>$featureds,
//                "latests1"=>$latests1,
//                "latests2"=>$latests2,
//                "categories"=> $categories,
//            ];
//            $data = Cache::get("home_page");
        }
        return Cache::get("home_page");
    }


    public function category(Category $category){//router model binding
        //$products = Product::where("category_id", $category->__get("id")->paginate(12));//c1 truy vấn thẳng trong bảng product
        $products = $category->Products()->simplePaginate(12);//cach 2 lấy quan hệ đối tượng dựa theo đối tượng
        return view("frontend.category", [
            "category"=>$category,//trả category về cho trang front end
            "products"=>$products,
            ]);
    }
    public function product(Product $product){//router model binding
        // đếm số lượng sản phẩm xem được
        if(!session()->has("view_count_{$product->__get("id")}"))// kiểm tra xem sesion  nếu chưa có sẽ đăng lên
        {
            $product->increment("view_count");// tự tăng lên 1 mỗi lần user ấn vào xem sản phẩm
            session(["view_count_{$product->__get("id")}=> true"]);// lấy session ra 1 session sẽ có giá trị lưu giữ trong vòng 2 tiếng
        }
        $relativeProducts = Product::with("Category")->paginate(4);//nạp sẵn phần cần nạp trong collection, lấy theo kiểu quan hệ
        return view("frontend.product", [
            "product"=>$product,
            "relativeProduct"=>$relativeProducts,
        ]);
    }
    public function addToCart(Product $product, Request $request){
        $qty = $request->has("qty") && (int) $request ->get("qty") > 0 ? (int) $request -> get("qty"):1;// kiểm tra qty co phai number hay khong
        // lay qty kiem tra neu la int > 0 thi se tra ve = qty = 1
        $myCart = session()->has("my_cart") && is_array(session("my_cart")) ? session("my_cart") : [];
        // kiem tra session neu co truong my_cart va mang my_cart neu khong co se truyen vao 1 mang rong~
        // nguyen tac lam trang gio hang se tang so luong chu khong tang san pham vao
        $contain = false;// dat 1 bien de kiem tra trang thai san pham co hay chua
        if(Auth::check()){//neu dang nhap roi
            if(Cart::where("user_id", Auth::id())
                    ->where("is_checkout", true)
                    ->exists())
            {
                $cart = Cart::where("user_id", Auth::id())
                            ->where("is_checkout", true)
                            ->first();
            }else{
                $cart = Cart::create([//hứng về đưa sang bảng trung gian
                    "user_id"=>Auth::id(),
                    "is_checkout"=>true
                ]);
            }
        }
        foreach ($myCart as $key=>$item) {
            if($item["product_id"] == $product -> __get("id"))  {// nếu sản phẩm đã có trong giỏ
                $myCart[$key]["qty"] += $qty;// nếu có thì sẽ truyền thêm vào biến qty ở trên
                $contain = true;// neu co san pham se truyen trang thai ve true
                DB::table("cart_product")->where("cart_id", $cart->__get("id"))
                    ->where("product_id", $item["product_id"])
                    ->update(["qty"=> $myCart[$key]["qty"]]);
                break;
            };
        }
        if(!$contain){ // nếu trả về true sẽ trả về 1 mảng mycart mới truyền vào qty và id sản phẩm hiện tại
            $myCart[] = [
                "product_id" => $product->__get("id"),
                "qty" => $qty,
            ];
            if(Auth::check()) {
                DB::table("cart_product")->insert([
                    "qty"=>$qty,
                    "cart_id"=>$cart->__get("id"),
                    "product_id"=>$product->__get("id"),
                ]);
            }
        }
        // nap lai session cũ
        session(["my_cart"=>$myCart]);

        // return redirect về trang trước
        return redirect()->to("/shopping-cart");
    }
    public function shoppingCart(){
        $myCart = session()->has("my_cart") && is_array(session("my_cart"))?session("my_cart"):[];
        $productIDs = [];
        foreach ($myCart as $item){
            $productIDs[] = $item["product_id"];
        }
        $grandTotal = 0;
        $products = \App\Product::find($productIDs);//truyen vao 1 mang gom cac id
        foreach ($products as $p){
            foreach ($myCart as $item){
                if ($p->__get("id") == $item["product_id"]){
                    $grandTotal += ($p->__get("price")*$item["qty"]);// tinh tong tien
                    $p->cart_qty = $item["qty"];// them doi tuong cart_qty de foreach ra mang
                   // dd($item);
                }
            }
        }
        return view("frontend.cart", [
            "products"=>$products,
            "grandTotal"=>$grandTotal,
        ]);
    }
    public function checkout(){
        $cart = Cart::where("user_id", Auth::id())->where("is_checkout", true)->with("getItems")->firstOrFail();
        return view("frontend.checkout", [
            "cart"=>$cart
        ]);
    }
    public function placeOrder(Request $request){
        $request->validate([
            "user_name"=>'required',
            "address"=>'required',
            "telephone"=>'required',
        ]);
        $cart = Cart::where("user_id", Auth::id())
            ->where("is_checkout", true)
            -> with("getItems")
            ->firstOrFail();
        $grandTotal = 0;
        foreach ($cart->getItems as $item){
            $grandTotal += $item->pivot->__get("qty")*$item->__get("price");
        }
        try {
            $order = Order::create([
                "user_id"=>Auth::id(),
                "user_name"=>$request->get("user_name"),
                "address"=>$request->get("address"),
                "telephone"=>$request->get("telephone"),
                "note"=>$request->get("note"),
                "grand_total"=>$grandTotal,
                "status"=> Order::PENDING,
            ]);
            foreach ($cart->getItems as $item){
                DB::table("orders_products")->insert([
                   "order_id"=>$order->__get("id"),
                   "product_id"=>$item->__get("id"),
                   "price"=>$item->__get("price"),
                   "qty"=>$item->pivot->__get("qty"),
                ]);
            }
            event(new OrderCreated($order));//Hàm phát ra sự kiện
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
        return redirect()->to("/home");
    }
    public function search(Request $request){
        $products = Product::where('product_name', 'like', '%'.$request->search.'%')->
                            orwhere('price', $request->search)->get();
        return view("frontend.search", [
            "products"=> $products
        ]);
    }
}
