<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSessionDuration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'user_id',
        'first_request_time',
        'last_request_time',
        'session_duration'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
