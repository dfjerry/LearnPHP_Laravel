<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Spanis</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
{{--                            Check xem đăng nhập chưa, đăng nhập rồi hiện logout, chưa đăng nhập hiện login--}}
                            @guest
                                <a href="#"><i class="fa fa-user"></i> Login</a>
                            @else
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{url("/home")}}"><img src="{{asset("img/logo.png")}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{url("/home")}}">Home</a></li>
                        <li><a href="{{url("/home")}}">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{url("/home")}}">Shop Details</a></li>
                                <li><a href="{{url("/shopping-cart")}}">Shoping Cart</a></li>
                                <li><a href="{{url("/checkout")}}">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    @php
                        $myCart = session()->has("my_cart")?session("my_cart"):[];
                        $count_item = count($myCart);
                        $productIds = [];
                        foreach ($myCart as $item){
                            $productIds[] = $item["product_id"];
                        }
                        $grandTotal = 0;
                        $products = \App\Product::find($productIds);//where in lay theo id, sum tính tổng tiền
                        foreach ($products as $p){
                            foreach ($myCart as $item){
                                if ($p->__get("id") == $item["product_id"]){
                                    $grandTotal += ($p->__get("price")*$item["qty"]);
                                }
                            }
                        }
                    @endphp
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="{{url("shopping-cart")}}"><i class="fa fa-shopping-bag"></i> <span>{{$count_item}}</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>{{$grandTotal}}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
