@extends('frontend.layout')
@section('content')
    <x-frontend.menu_nav/>
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{url("/checkout")}}" method="post">
                    @method("POST")
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p> Name<span>*</span></p>
                                <input  name="user_name" value="{{\Illuminate\Support\Facades\Auth::user()->__get("name")}}" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input class="@error("address") is-invalid @enderror" name="address"  type="text">
                                @error("address")
                                <span class="error invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>TelePhone<span>*</span></p>
                                <input class="@error("telephone") is-invalid @enderror" name="telephone" type="text">
                                @error("telephone")
                                <span class="error invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Note<span>*</span></p>
                                <input name="note" type="text">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @php $grandTotal = 0 @endphp
                                    @foreach($cart->getItems as $item)
                                        <li>{{$item->__get("product_name")}}
                                            <span>${{$item->__get("price")* $item->pivot->__get("qty")}}</span>
                                        </li>
                                        @php $grandTotal += ($item->__get("price")* $item->pivot->__get("qty"))@endphp
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>${{$grandTotal}}</span></div>
                                <div class="checkout__order__total">Total <span>${{$grandTotal}}</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
