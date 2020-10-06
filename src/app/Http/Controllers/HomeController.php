<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSetting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        return view('home', [
            'user' => $user,
        ]);
    }

    public function showSet()
    {
        $user = Auth::user();

        return view('setting.set', [
            'user' => $user,
        ]);
    }

    public function set(EditSetting $request)
    {
        $user = Auth::user();

        $user->expiring_date = $request->expiring_date;
        $user->what_time_mail_hour = sprintf('%02d', $request->what_time_mail_hour);
        $user->what_time_mail_minute = sprintf('%02d', $request->what_time_mail_minute);
        $user->how_days_mail = $request->how_days_mail;
        $user->update();

        return redirect()->route('home');
    }

    public function setForTestUser()
    {
        $user = Auth::user();

        $hour = date("H", strtotime(Carbon::now()));
        $minute = date("i", strtotime(Carbon::now(). "+ 1 minute"));

        $user->expiring_date = 0;
        $user->what_time_mail_hour = sprintf('%02d', $hour);
        $user->what_time_mail_minute = sprintf('%02d', $minute);
        $user->how_days_mail = 0;
        $user->update();

        return redirect()->route('home');
    }
}
