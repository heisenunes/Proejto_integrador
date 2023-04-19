<?php

namespace App\Models;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'topic_id',
        'title',
        'content',
        'order_id',
        'created_at',
        'updated_at'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
