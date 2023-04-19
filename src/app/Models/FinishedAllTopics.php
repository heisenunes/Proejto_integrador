<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FinishedAllTopics extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rewarded',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
