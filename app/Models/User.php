<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'device_id',
        'email',
        'password',
        'telegram'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
//    protected $hidden = [
//        'password',
//    ];

    public function survey(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Survey::class, 'device_id', 'device_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }

}
