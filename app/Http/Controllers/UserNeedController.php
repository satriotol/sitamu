<?php

namespace App\Http\Controllers;

use App\Mail\UserNeedEmail;
use App\Models\SurveyAnswer;
use App\Models\User;
use App\Models\UserNeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Services\SendWhatsappService;

class UserNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:kunjunganTamu-list|kunjunganTamu-create|kunjunganTamu-edit|kunjunganTamu-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kunjunganTamu-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kunjunganTamu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kunjunganTamu-delete', ['only' => ['destroy']]);
    }
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
        $users = User::role('VISITOR')->get();
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

        $user_need = UserNeed::create($data);
        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'VISITOR');
        })->get();
        foreach ($admins as $key => $admin) {
            SendWhatsappService::sendWhatsapp($admin->name, $admin->phone);
        }
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
        $users = User::role('VISITOR')->get();
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
    public function user_need_visitor(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            'guide_name' => 'required',
            'name' => 'required',
            'image' => 'required|image',
            'survey.*.value' => 'required',
            'survey.*.id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data['user_id'] = Auth::user()->id;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = $file->getClientOriginalName();
                $file_name = date('mdYHis') . '-' . $name;
                $image = $file->storeAs('image', $file_name, 'public_uploads');
                $data['image'] = $image;
            };

            $userNeed = UserNeed::create([
                'user_id' => Auth::user()->id,
                'guide_name' => $data['guide_name'],
                'image' => $data['image'],
                'name' => $data['name'],
            ]);
            $admins = User::whereHas('roles', function ($q) {
                $q->where('name', '!=', 'VISITOR');
            })->get();
            foreach ($admins as $key => $admin) {
                SendWhatsappService::sendWhatsapp($admin->name, $admin->phone);
            }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollback();
        }
        session()->flash('success');
        return back();
    }
    public function changeStatus(UserNeed $user_need)
    {
        $user_need->update([
            'admin_id' => Auth::user()->id,
        ]);
        SendWhatsappService::sendWhatsappToVisitor($user_need->user->name, $user_need->user->user_detail->phone);
        session()->flash('success');
        return back();
    }
}
