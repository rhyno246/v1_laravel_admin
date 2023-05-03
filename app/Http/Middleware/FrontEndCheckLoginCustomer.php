<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontEndCheckLoginCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('users')){
            return redirect()->route('login')->with('fail' , 'Bạn chưa đăng nhập');
        }
        return $next($request);
    }
}
