<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Topic;

class TopicVisits extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'topic_visits';

    protected $fillable = [
        'topic_id',
        'day',
        'count',
    ];

    public function topic() : BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
