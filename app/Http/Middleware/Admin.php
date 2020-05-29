<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        //kiểm tra nếu chưa đăng nhập
//        if(!Auth::check())
//            return redirect()->to("login");//nếu chưa đăng nhập trả về trang login
        //lấy đối tượng user đang đăng nhập
        $currentUser = Auth::user();
        if($currentUser->__get("role") != User::ADMIN_ROLE)
            return abort(404);//nếu khác admin trả về trang 404
        return $next($request);//nếu là admin cho đi tiếp giao diện admin
    }
}
