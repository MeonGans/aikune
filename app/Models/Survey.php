<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'device_id',
        'aim',
        'name',
        'sex',
        'body_type',
        's5_back',
        's6_activity',
        's7_day',
        's8_attention',
        's9_training',
        's10',
        's11_backache',
        's12',
        's13_usually',
        's14_legs',
        's15_diseases',
        's16',
        's17_sit',
        's18_position',
        's19_see',
        's20_sleep',
        's21_exercises',
        'age',
        'weight',
        'height',
    ];
}
