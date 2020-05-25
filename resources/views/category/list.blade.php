@extends('layout')
@section("title", "Category Listing")
@section("contentHeader","Category")
{{--contentHeader là yield và "Category" là giá trị của biến do mình đặt ở file này--}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category Listing</h3>
            <a href="{{url('/new-category')}}" class="btn btn-outline-dark ml-3">+</a>

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
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit Category</th>
                    <th>Delete Category</th>
                    <th>Product Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->__get("id")}}</td>
                    <td>{{$category->__get("category_name")}}</td>
                    <td>{{$category->__get("created_at")}}</td>
                    <td>{{$category->__get("updated_at")}}</td>
                    <td>
                        <a href="{{url("/edit-category/{$category->__get("id")}")}}" class="btn btn-outline-dark">Edit</a>
                    </td>
                    <td>
                        <form action="{{url("/delete-category/{$category->__get("id")}")}}" method="post">
                            @method("DELETE")
                            @csrf
{{--                            nếu ko có @csrf tạo mã token sẽ bị lỗi 419--}}
                            <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-outline-dark">Delete</button>
                        </form>
                    </td>

                    <td>{{$category->__get("products_count")}}</td>
{{--                    Link đến $category cần edit--}}
                </tr>
                    @endforeach
                {{-- Cú pháp của vòng lặp blade engine thay cho php echo--}}
                </tbody>
            </table>

        </div>

        <!-- /.card-body -->
    </div>
    {!! $categories->links() !!}
{{--    {!! $categories->links('view.name') !!}--}}

    @endsection
