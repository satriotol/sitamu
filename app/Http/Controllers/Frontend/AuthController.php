<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Else_;

class AuthController extends Controller
{
    public function index()
    {
        return view('frontend.pages.auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            if ($user->role == 'VISITOR') {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'Sayangnya Akun Anda Bukan Pengunjung',
                ])->onlyInput('email');
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function register()
    {
        return view('frontend.pages.auth.register');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('frontend.login'));
    }
}
