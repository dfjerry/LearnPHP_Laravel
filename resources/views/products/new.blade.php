@extends("layout")
@section("title", "Create a new product")
@section("contentHeader","Create a new product")
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create new Product</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url("save-product")}}" method="post" enctype="multipart/form-data">
{{--            Bắt buộc phỉa thêm multipart/form-date để lưu trữ file dạng khác text--}}
            @method("POST")
            {{--            @method("POST") báo route--}}
            @csrf
            {{--         tạo mã token, nếu thiếu báo lỗi 419 do ko có mã token   --}}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input class="form-control @error("product_name") is-invalid @enderror" type="text" name="product_name" id="exampleInputEmail1" placeholder="Enter name"/>
                    @error("product_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Image</label>
                    <input class="form-control @error("product_image") is-invalid @enderror" type="file" name="product_image" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Desc</label>
                    <textarea name="product_desc" class="form-control @error("product_desc") is-invalid @enderror" cols="30" rows="10" placeholder="Description..." ></textarea>
                    @error("product_desc")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input class="form-control @error("price") is-invalid @enderror" type="text" name="price" id="exampleInputEmail1" placeholder="Enter price">
                    @error("price")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input class="form-control @error("qty") is-invalid @enderror" type="text" name="qty" id="exampleInputEmail1" placeholder="Enter quantity">
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
