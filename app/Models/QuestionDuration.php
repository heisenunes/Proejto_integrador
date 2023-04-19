<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Question;

class QuestionDuration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'question_durations';

    protected $fillable = [
        'user_id',
        'question_id',
        'first_request_time',
        'duration',
    ];

    public function question() : BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
