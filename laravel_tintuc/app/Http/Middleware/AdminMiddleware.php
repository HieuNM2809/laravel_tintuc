<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();

            // user->Xoa : 0 là chưa xóa tài khoản , 1: là tài khoản bị xóa
            if(($user->role == 'admin' || $user->role == 'staff')  && $user->Xoa == 0){
                
                // share cho toàn view=
                view()->share('user_login_admin', Auth::user());
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect('admin/login')->with('thongbao', 'Bạn không đủ quyền truy cập');
            }
        }
        return redirect('admin/login');
    }
}
