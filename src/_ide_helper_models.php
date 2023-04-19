<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Answer
 *
 * @property int $id
 * @property int $question_id
 * @property string $content
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Answer whereUpdatedAt($value)
 */
	class Answer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AnsweredQuestions
 *
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question $question
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnsweredQuestions whereUserId($value)
 */
	class AnsweredQuestions extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FinishedAllTopics
 *
 * @property int $id
 * @property int $user_id
 * @property bool $rewarded
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics whereRewarded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedAllTopics whereUserId($value)
 */
	class FinishedAllTopics extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FinishedTopic
 *
 * @property int $id
 * @property int $topic_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Topic $topic
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedTopic whereUserId($value)
 */
	class FinishedTopic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $topic_id
 * @property int $order_id
 * @property string $title
 * @property string $content
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Topic $topic
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $topic_id
 * @property int $order_id
 * @property string $content
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $correct_answer_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnsweredQuestions[] $answeredQuestions
 * @property-read int|null $answered_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Answer|null $correctAnswer
 * @property-read \App\Models\Topic $topic
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCorrectAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Topic
 *
 * @property int $id
 * @property int $order_id
 * @property string $title
 * @property string $brief
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $homepage_image_id
 * @property int $icon_image_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnsweredQuestions[] $answeredQuestions
 * @property-read int|null $answered_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FinishedTopic[] $finishedTopics
 * @property-read int|null $finished_topics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \App\Models\Image|null $topicIcon
 * @property-read \App\Models\Image|null $topicLogo
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereBrief($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereHomepageImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereIconImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedAt($value)
 */
	class Topic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $rewarded
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnsweredQuestions[] $answeredQuestions
 * @property-read int|null $answered_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FinishedAllTopics[] $finishedAllTopics
 * @property-read int|null $finished_all_topics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FinishedTopic[] $finishedTopics
 * @property-read int|null $finished_topics_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRewarded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

