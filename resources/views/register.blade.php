@extends("layout");
@section("content")
    <form action="#" method="post" style="border: 1px solid #cccccc; padding: 20px 50px; background-color: aquamarine">
        <x-inputs.textField name="name" holder="Name"/>
        <x-inputs.email name="email" holder="Email"/>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection;

