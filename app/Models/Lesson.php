<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['bad', 'normal', 'great'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();;
    }
}
