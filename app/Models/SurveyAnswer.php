<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'survey_question_id', 'user_need_id'];

    public function survey_question()
    {
        return $this->belongsTo(SurveyQuestion::class, 'survey_question_id', 'id');
    }
    public function user_need()
    {
        return $this->belongsTo(UserNeed::class, 'user_need_id', 'id');
    }
}
