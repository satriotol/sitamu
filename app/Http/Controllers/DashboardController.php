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
        $user = User::role('VISITOR')->get()->count();
        $user_need_not_null = UserNeed::whereNotNull('admin_id')->count();
        $user_need_null = UserNeed::whereNull('admin_id')->count();
        $cctv = Cctv::all()->count();
        $surveyQuestions = SurveyQuestion::all();
        $dataBulanan = $this->monthlyChart();
        return view('dashboard', compact('user', 'dataBulanan', 'cctv', 'surveyQuestions',  'user_need_not_null', 'user_need_null'));
    }
    public function monthlyChart()
    {
        $data = UserNeed::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function ($item) {
                return $item->count();
            });

        $labels = [];
        $values = [];

        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $labels[] = $i;
            $dayData = $data->get(Carbon::createFromDate(null, Carbon::now()->month, $i)->format('Y-m-d'));
            $values[] = $dayData ? $dayData : 0;
        }
        return [$labels, $values];
    }
}
