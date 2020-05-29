@extends("layout")
@section("title", "Create a new brand")
@section("contentHeader","Create a new brand")
@section("content")
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Brand</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url("/admin/update-brand/{$brand->__get("id")}")}}" method="post">
            @method("PUT")
            {{--            @method("POST") báo route--}}
            @csrf
            {{--         tạo mã token, nếu thiếu báo lỗi 419 do ko có mã token   --}}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand Name</label>
                    <input value="{{$brand->__get("brand_name")}}" class="form-control @error("brand_name") is-invalid @enderror" type="text" name="brand_name" id="exampleInputEmail1" placeholder="Enter name">
                    @error("brand_name")
                    <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>

@endsection
