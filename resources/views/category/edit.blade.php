@extends("layout")
@section("title", "Create a new category")
@section("contentHeader","Create a new category")
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url("/admin/update-category/{$category->__get("id")}")}}" method="post" enctype="multipart/form-data">
            @method("PUT")
{{--            edit nen method = PUT --}}
            {{--            @method("POST") báo route--}}
            @csrf
            {{--         tạo mã token, nếu thiếu báo lỗi 419 do ko có mã token   --}}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input value="{{$category->__get("category_name")}}" class="form-control @error("category_name") is-invalid @enderror" type="text" name="category_name" id="exampleInputEmail1" placeholder="Enter name">
                    @error("category_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div><label for="exampleInputEmail1">Category Image</label></div>
                    <img src="{{$category->getImage()}}" style="width: 70px; height: 70px;"/>
                    <input class="form-control @error("category_image") is-invalid @enderror" type="file" name="category_image" />
                    @error("category_image")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
