<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserNeed;
use Illuminate\Http\Request;

class UserNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_needs = UserNeed::all();
        return view('pages.user_visitor.index', compact('user_needs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'VISITOR')->get();
        return view('pages.user_visitor.create', compact('users'));
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
            'user_id' => 'required',
            'guide_name' => 'required',
            'name' => 'required',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $image = $file->storeAs('image', $file_name, 'public_uploads');
            $data['image'] = $image;
        };

        UserNeed::create($data);
        session()->flash('success');
        return redirect(route('user_need.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserNeed  $user_need
     * @return \Illuminate\Http\Response
     */
    public function show(UserNeed $user_need)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserNeed  $user_need
     * @return \Illuminate\Http\Response
     */
    public function edit(UserNeed $user_need)
    {
        $users = User::where('role', 'VISITOR')->get();
        return view('pages.user_visitor.create', compact('user_need', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserNeed  $user_need
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserNeed $user_need)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'guide_name' => 'required',
            'name' => 'required',
            'image' => 'nullable|image',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $image = $file->storeAs('image', $file_name, 'public_uploads');
            $user_need->deleteImage();
            $data['image'] = $image;
        };
        $user_need->update($data);
        session()->flash('success');
        return redirect(route('user_need.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserNeed  $user_need
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserNeed $user_need)
    {
        $user_need->deleteImage();
        $user_need->delete();
        session()->flash('success');
        return redirect(route('user_need.index'));
    }
}
