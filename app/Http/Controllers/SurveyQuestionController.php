<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveyQuestions = SurveyQuestion::all();
        return view('pages.surveyQuestion.index', compact('surveyQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.surveyQuestion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question.*' => 'required',
        ]);
        foreach ($request->question as $key => $value) {
            SurveyQuestion::create([
                'question' => $value,
            ]);
        }
        session()->flash('success');
        return redirect()->route('surveyQuestion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(SurveyQuestion $surveyQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(SurveyQuestion $surveyQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SurveyQuestion $surveyQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurveyQuestion $surveyQuestion)
    {
        $surveyQuestion->delete();
        session()->flash('success');
        return back();
    }
}
