<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd($request); //インスタンス化したRequestクラス
        // dd($guard); //null
        if (Auth::guard($guard)->check()) {
            // ログイン済みであればredirect('/home')で終了
            return redirect('/home');
        }
        // dd($next($request)); //インスタンス化したResponseクラス
        return $next($request);
    }
}
