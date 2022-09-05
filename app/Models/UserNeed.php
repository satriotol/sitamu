<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class UserNeed extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'guide_name', 'image', 'name', 'admin_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
    public function survey_answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'user_need_id', 'id');
    }
    public function deleteImage()
    {
        Storage::disk('public_uploads')->delete($this->attributes['image']);
    }

    // public function getImageAttribute()
    // {
    //     $image = env('ASSET_URL') . '/uploads/' . $this->attributes['image'];
    //     return $image;
    // }
}
