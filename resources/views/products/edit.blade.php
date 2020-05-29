@extends("layout")
@section("title", "Edit a new product")
@section("contentHeader","Edit a new product")
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit product</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url("/admin/update-product/{$product->__get("id")}")}}" method="post" enctype="multipart/form-data">
            @method("PUT")
            {{--            edit nen method = PUT --}}
            {{--            @method("POST") báo route--}}
            @csrf
            {{--         tạo mã token, nếu thiếu báo lỗi 419 do ko có mã token   --}}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input value="{{$product->__get("product_name")}}" class="form-control @error("product_name") is-invalid @enderror" type="text" name="product_name" placeholder="Enter name">
                    @error("product_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div><label for="exampleInputEmail1">Product Image</label></div>
                    <img src="{{$product->getImage()}}" style="width: 70px; height: 70px;"/>
                    <input class="form-control @error("product_image") is-invalid @enderror" type="file" name="product_image" />
                    @error("product_image")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Desc</label>
                    <input value="{{$product->__get("product_desc")}}" class="form-control @error("product_desc") is-invalid @enderror" type="text" name="product_desc" placeholder="Desc">
                    @error("product_desc")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Price</label>
                    <input value="{{$product->__get("price")}}" class="form-control @error("price") is-invalid @enderror" type="text" name="price" placeholder="Price">
                    @error("price")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Qty</label>
                    <input value="{{$product->__get("qty")}}" class="form-control @error("qty") is-invalid @enderror" type="text" name="qty" placeholder="Enter qty">
                    @error("qty")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->__get("id")}}">{{$category->__get("category_name")}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control">
                        @foreach($brands as $brand)
                            <option value="{{$brand->__get("id")}}">{{$brand->__get("brand_name")}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
