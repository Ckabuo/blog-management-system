<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'slug',
        'content',
        'image_url',
        'views',
        'likes',
        'user_id'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
}
