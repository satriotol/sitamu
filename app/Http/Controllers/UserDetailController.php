<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Iman\Streamer\VideoStreamer;
use Spatie\Permission\Models\Role;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_details = UserDetail::all();
        return view('pages.user_detail.index', compact('user_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $path = 'http://streaming.cctvsemarang.katalisindonesia.com/live/5euomh9otpDm6BvlRHC8bppjIEMBQeUROGghC_Ud352XV13LvlVdwGgiJvvpN8jL9DwuiyyxmO7yw-zJCE5JCpXcWAoSvFmG.m3u8';

        return view('pages.user_detail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return redirect(route('user_detail.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetail $userDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetail $user_detail)
    {
        return view('pages.user_detail.create', compact('user_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDetail $user_detail)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user_detail->user_id,
            'password' => 'sometimes',
            'phone' => 'required',
            'instansi' => 'required',
        ]);
        if ($request->password != null) {
            $user_detail->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        } else {
            $user_detail->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
        }
        $user_detail->update([
            'name' => $data['phone'],
            'insntasi' => $data['instansi'],
        ]);
        $role = Role::where('name', 'VISITOR')->first();
        $user_detail->user->assignRole($role->id);
        session()->flash('success');
        return redirect(route('user_detail.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetail $user_detail)
    {
        $user_detail->delete();
        $user_detail->user->delete();
        session()->flash('success');
        return redirect(route('user_detail.index'));
    }
}
