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
            $this->kirim_wa($admin->phone, $user_need->user->name);
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
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'VISITOR');
        })->get();

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
            foreach ($data['survey'] as $d) {
                SurveyAnswer::create([
                    'value' => $d['value'],
                    'user_need_id' => $userNeed->id,
                    'survey_question_id' => $d['id'],
                ]);
            }
            // foreach ($users as $user) {
            //     Mail::to($user->email)->send(new UserNeedEmail($userNeed));
            // }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollback();
        }
        session()->flash('success');
        return back();
    }
    public function kirim_wa($phone_no, $nama)
    {
        $message = "Ada Pengunjung Baru " . $nama;

        $message = preg_replace("/(\n)/", "<ENTER>", $message);
        $message = preg_replace("/(\r)/", "<ENTER>", $message);

        $phone_no = preg_replace("/(\n)/", ",", $phone_no);
        $phone_no = preg_replace("/(\r)/", "", $phone_no);

        $data = array("phone_no" => $phone_no, "key" => "e4d16a0772635a648acd790503fe71a9ebcd9f538952dfbc", "message" => $message);
        $data_string = json_encode($data);
        $ch = curl_init('http://116.203.92.59/api/send_message');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        $result = curl_exec($ch);
    }
}
