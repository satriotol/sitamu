<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        $user = Auth::user();
        return ResponseFormatter::success($user, 'Success');
    }
    public function user_update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id
        ]);
        $user->update($data);
        return $user;
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Pastikan Form Anda Sudah Lengkap Dan', 500);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Terjadi Kesalahan', 500);
        }
    }
    public function register(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return ResponseFormatter::error([
                'error' => $e
            ], 'Terjadi Kelasahan Pastikan Form Anda Sudah Benar', 500);
        }
        return ResponseFormatter::success([
            'user' => $user
        ], 'Authenticated');
    }
}
