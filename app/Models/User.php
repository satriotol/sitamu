<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'total_visit'
    ];

    public function user_detail()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }
    public function user_needs()
    {
        return $this->hasMany(UserNeed::class, 'user_id', 'id');
    }
    public function getTotalVisitAttribute()
    {
        return (string)$this->user_needs()->count();
    }
    public static function getAdmin()
    {
        $user = Auth::user();
        if ($user->email == 'satriotol69@gmail.com') {
            return static::where('email', '!=', 'satriotol69@gmail.com')->whereHas('roles', function ($q) {
                $q->where('name', '!=', 'VISITOR');
            })->get();
        } else {
            return static::whereHas('roles', function ($q) {
                $q->where('name', '!=', 'VISITOR');
            })->get();
        }
    }
}
