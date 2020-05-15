@extends("layout")
@section("content")
    <form>
        <x-inputs.email name="email" holder="Email"/>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endsection
