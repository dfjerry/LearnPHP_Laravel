@extends("layout")
@section("content")
        <form>
            <x-inputs.email type="type" name="email" holder="Email"/>
            <x-inputs.password type="password" name="password" holder="Password"/>
            <x-inputs.button/>
        </form>
        <a style="color: black; margin-left: 100px; margin-top: 30px" href="#">Forgot password? <b>Click Here</b></a>
    @endsection
