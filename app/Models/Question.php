<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Answer;
use App\Models\Topic;
use App\Models\AnsweredQuestions;
use App\Models\QuestionDuration;


class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'topic_id',
        'content',
        'correct_answers',
        'incorrect_answers',
        'order_id',
    ];

    public function topic() : BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function answers() : HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function durations() : HasMany
    {
        return $this->hasMany(QuestionDuration::class);
    }

    public function correctAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
//        return Answer::where('id', $this->correct_answer_id);
    }

    public function answeredQuestions() : HasMany
    {
        return $this->hasMany(AnsweredQuestions::class);
    }
}
