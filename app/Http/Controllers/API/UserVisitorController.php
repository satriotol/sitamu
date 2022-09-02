<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;
use App\Models\UserNeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserVisitorController extends Controller
{
    public function getSurvey()
    {
        $surveys = SurveyQuestion::all();
        return ResponseFormatter::success($surveys, 'Sukses Mendapatkan Data');
    }
    public function user_visitor(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            'guide_name' => 'required',
            'name' => 'required',
            'image' => 'nullable',
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
            foreach ($data['survey'] as $d) {
                SurveyAnswer::create([
                    'value' => $d['value'],
                    'user_need_id' => $userNeed->id,
                    'survey_question_id' => $d['id'],
                ]);
            }
            return ResponseFormatter::success('Sukses Menambahkan Kunjungan', 'Sukses Menambahkan Kunjungan');
            // foreach ($users as $user) {
            //     Mail::to($user->email)->send(new UserNeedEmail($userNeed));
            // }
            DB::commit();
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollback();
        }
    }
}
