<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            $request->session()->regenerate();
            return redirect(route('dashboard'));
        }
        return back()->withErrors([
            'Oops Ada Error, Coba Ulangin Lagi',
        ])->onlyInput('email');
    }
    public function register()
    {
        return view('frontend.pages.auth.register');
    }
    public function register_post(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
            'instansi' => 'required',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        UserDetail::create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'instansi' => $data['instansi'],
        ]);
        $role = Role::where('name', 'VISITOR')->first();
        $user->assignRole($role->id);

        session()->flash('success');
        return redirect(route('login'));
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('frontend.login'));
    }
}
