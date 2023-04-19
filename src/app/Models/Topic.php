<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;


use App\Models\Post;
use App\Models\Question;
use App\Models\Image;
use App\Models\FinishedTopic;
use App\Models\AnsweredQuestions;
use App\Models\TopicVisits;


class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'brief',
        'order_id',
        'homepage_image_id',
        'number_of_visits',
        'icon_image_id',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(TopicVisits::class);
    }

    public function topicLogo()
    {
        return $this->hasOne(Image::class, 'id', 'homepage_image_id');
    }

    public function topicIcon()
    {
        return $this->hasOne(Image::class, 'id', 'icon_image_id');
    }

    public function finishedTopics()
    {
        return $this->hasMany(FinishedTopic::class);

    }

    public function answeredQuestions(): HasMany
    {
        return $this->hasMany(AnsweredQuestions::class);
    }

    public function nrQuestionsAnsweredByUser()
    {

        return AnsweredQuestions::wherein('question_id', Question::where('topic_id', $this->id)->where('active', true)->select('id'))->where('user_id', Auth::user()->id)->count();

    }

    public function nrActiveQuestions()
    {

        return Question::where('topic_id', $this->id)->where('active', true)->select('id')->count();

    }

    public function isFinishedByUser()
    {
        return FinishedTopic::where('user_id', Auth::user()->id)->where('topic_id', $this->id)->exists();
    }

    public function lastPost() {
        return Post::where('topic_id', $this->id)->latest('order_id')->first();
    }
}
