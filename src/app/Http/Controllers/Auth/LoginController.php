<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
      return 'name';
    }

    protected function authenticated(\Illuminate\Http\Request $request, $user)
  {
    // ここに追加したい処理を書く
    // 今回は例としてログインの履歴をDBに書き込み
    $user = Auth::user();
    $user->expiring_date = '1';
    $user->what_time_mail_hour = '10';
    $user->what_time_mail_minute = '00';
    $user->how_days_mail = '1';
    $user->save();
    
    // ログイン後のリダイレクト
    return redirect($this->redirectTo);
  }

  public function logout(Request $request)
  {
    $user = Auth::user();
    $user->expiring_date = '1';
    $user->what_time_mail_hour = '10';
    $user->what_time_mail_minute = '00';
    $user->how_days_mail = '1';
    $user->save();

    $this->guard()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return $this->loggedOut($request) ?: redirect('/');
  }
}
