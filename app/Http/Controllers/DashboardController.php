<?php

namespace App\Http\Controllers;

use App\Models\Cctv;
use App\Models\User;
use App\Models\UserNeed;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'ADMIN')->get()->count();
        $user = User::where('role', 'VISITOR')->get()->count();
        $user_need = UserNeed::all()->count();
        $cctv = Cctv::all()->count();
        return view('dashboard', compact('admin', 'user','user_need','cctv'));
    }
}
