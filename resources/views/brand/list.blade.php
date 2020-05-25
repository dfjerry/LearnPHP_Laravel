@extends('layout')
@section("title", "Brand Listing")
@section("contentHeader","Brand")
{{--contentHeader là yield và "Category" là giá trị của biến do mình đặt ở file này--}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Brand Listing</h3>
            <a href="{{url('/new-brand')}}" class="btn btn-outline-dark ml-3">+</a>

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
                    <th>Brand Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit Brand</th>
                    <th>Delete Brand</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($brands as $brand)
                <tr>
                    <td>{{$brand->__get("id")}}</td>
                    <td>{{$brand->__get("brand_name")}}</td>
                    <td>{{$brand->__get("created_at")}}</td>
                    <td>{{$brand->__get("updated_at")}}</td>
                    <td><a href="{{url("/edit-brand/{$brand->__get("id")}")}}" class="btn btn-outline-dark">Edit</a></td>
                    <td>
                        <form action="{{url("/delete-brand/{$brand->__get("id")}")}}" method="post">
                            @method("DELETE")
                            @csrf
                            <button class="btn btn-outline-dark" type="submit" onclick="return confirm('Are you sure?');">Delete</button>
                        </form>
                    </td>
                </tr>
                    @endforeach
                {{-- Cú pháp của vòng lặp blade engine thay cho php echo--}}
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    {!! $brands->links() !!}
    @endsection
