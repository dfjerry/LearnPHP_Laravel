@extends('layout')
@section("title", "Product Listing")
@section("contentHeader","Product")
{{--contentHeader là yield và "Category" là giá trị của biến do mình đặt ở file này--}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Product Listing</h3>
            <a href="{{url('/new-product')}}" class="btn btn-outline-dark ml-3">+</a>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Create At</th>
                    <th>Update At</th>
                    <th>Edit Category</th>
                    <th>Delete Category</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
{{--                    @php--}}
{{--                    var_dump($product);--}}
{{--                    dd($product->Category)--}}
{{--                    @endphp--}}
                    <tr>
                        <td>{{$product->__get("id")}}</td>
                        <td><img src="{{$product->getImage()}}" style="width: 50px; height: 50px;"/></td>
                        <td>{{$product->__get("product_desc")}}</td>
                        <td>{{number_format($product->__get("price"))}}</td>
                        <td>{{$product->__get("qty")}}</td>
                        <td>{{$product->Category->__get("category_name")}}</td>
                        <td>{{$product->Brand->__get("brand_name")}}</td>
                        <td>{{$product->__get("created_at")}}</td>
                        <td>{{$product->__get("updated_at")}}</td>
                        <td>
                            <a href="{{url("/edit-category/{$product->__get("id")}")}}" class="btn btn-outline-dark">Edit</a>
                        </td>
                        <td>
                            <form action="{{url("/delete-category/{$product->__get("id")}")}}" method="post">
                                @method("DELETE")
                                @csrf
                                {{--                            nếu ko có @csrf tạo mã token sẽ bị lỗi 419--}}
                                <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-outline-dark">Delete</button>
                            </form>
                        </td>
                        {{--                    Link đến $category cần edit--}}
                    </tr>
                @endforeach
                {{-- Cú pháp của vòng lặp blade engine thay cho php echo--}}
                </tbody>
            </table>

        </div>

        <!-- /.card-body -->
    </div>
    {!! $products->links() !!}
    {{--    {!! $categories->links('view.name') !!}--}}

@endsection
