<?php

namespace App\Traits;

use App\Models\Like;

trait HasLike
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function alreadyLiked()
    {
        return $this->likes()->where('user_id', auth()?->id())->exists();
    }
}