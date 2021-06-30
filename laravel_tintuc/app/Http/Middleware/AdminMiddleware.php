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
            if($user->role == 1){
                // share cho toàn view
                if(Auth::check()){
                    view()->share('user_login_admin', Auth::user());
                }
                return $next($request);
            }
            else{
                return redirect('admin/login');
            }
        }
        return redirect('admin/login');
    }
}
