<?php

namespace App\Http\Controllers;

use App\Models\Cctv;
use App\Models\SurveyQuestion;
use App\Models\User;
use App\Models\UserNeed;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = User::role('ADMIN')->get()->count();
        $user = User::role('VISITOR')->get()->count();
        $user_need = UserNeed::all()->count();
        $cctv = Cctv::all()->count();
        $surveyQuestions = SurveyQuestion::all();

        for ($i = 0; $i < 31; $i++) {
            $params[] = $i + 1;
        }
        
        // $period = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        $period = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        $dates = $period->count();
        $thisMonth  = Carbon::now()->startOfMonth()->format('F Y');
        for ($i = 0; $i < $dates; $i++) {
            $startOfWeek        = Carbon::now()->startOfMonth()->addDay($i);
            $order_jawa[] = UserNeed::whereDay('created_at', '=', $startOfWeek)->get()->count();
        }
        $order_jawa;
        $data_week = [
            'thisMonth' => "$thisMonth",
            'params' => $params,
            'data' => $order_jawa,
        ];
        return view('dashboard', compact('admin', 'user', 'user_need', 'cctv', 'surveyQuestions', 'data_week'));
    }
}
