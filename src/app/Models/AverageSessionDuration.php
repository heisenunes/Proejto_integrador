<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AverageSessionDuration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'average_session_durations';

    protected $fillable = [
        'day',
        'average_duration',
        'session_count'
    ];
}
