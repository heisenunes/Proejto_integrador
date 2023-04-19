<?php

namespace App\Models;

use App\Notifications\MailResetPasswordToken;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'rewarded',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function answeredQuestions(): HasMany
    {
        return $this->hasMany(AnsweredQuestions::class);
    }

    public function topicAnsweredQuestions(Topic $topic): HasMany
    {
        return $this->answeredQuestions()->where('topic_id', $topic->id);
    }

    public function userSessionDurations(): HasMany
    {
        return $this->hasMany(UserSessionDuration::class);
    }

    public function getAnsweredQuestions(User $user): int
    {
        return $user->answeredQuestions->count();
    }

    public function finishedTopics(): HasMany
    {
        return $this->hasMany(FinishedTopic::class);
    }

    public function finishedAllTopics(): HasMany
    {
        return $this->hasMany(FinishedAllTopics::class);
    }

    public function getFinishedTopics(User $user): int
    {
        return $user->finishedTopics->count();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'Admin';
    }

    public function answeredQuestion($questionId): bool
    {
        return $this->answeredQuestions->where('question_id', $questionId)->count() > 0;
    }

    public function getFirstUnansweredQuestion(Topic $topic): Model|null
    {
        return $topic->questions()
            ->whereNotIn('id', $this->topicAnsweredQuestions($topic)->select('question_id'))
            ->orderBy('order_id')
            ->first();
    }

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
}
