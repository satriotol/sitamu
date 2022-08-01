<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('frontend.pages.auth.login');
    }
    public function register(){
        return view('frontend.pages.auth.register');
    }
}
