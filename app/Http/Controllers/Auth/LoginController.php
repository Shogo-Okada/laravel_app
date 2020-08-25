<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers; //logoutメソッドがなくても動く理由
use Illuminate\Http\Request;  // 追記

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    protected $maxAttempts = 3;     // ログイン試行回数（回）
    /**
     * Where to redirect users after login.
     *
     * @var string
     * '/home' から変更
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     * logoutメソッドは除く
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

// logout後の背に先
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
// ここまで追記
}
