<?php

namespace App\Http\Controllers;

use App\Models\conversations;
use App\Models\have_chat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use shweshi\OpenGraph\OpenGraph;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use App\Models\users;

class loginController extends Controller
{
    public function defaultRedirect()
    {
        return redirect()->route('login');
    }
    function getUser()
    {
        $user = Auth::guard('web')->user();
        return $user;
    }
    public function index()
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            return redirect()->route('newHomePage', compact('user'));
        } else {
            return view('login/index');
        }
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();
            users::where('id', $user->id)->update(['status' => 'online']);
            return redirect()->route('newHomePage');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        $user = $this->getUser();
        users::where('id', $user->id)->update(['status' => 'offline']);
        Auth::logout();
        return redirect()->route('login');
    }
    public function register()
    {
        $m = 7;
        $d = 4;
        $y = 1998;
        $date = $m . '/' . $d . '/' . $y;
        return view('login/register', compact('date'));
    }
}
