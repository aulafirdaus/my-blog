<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, HasLike;

    protected $fillable = [
        'user_id', 'category_id', 'picture', 'title', 'slug', 'body'
    ];

    protected $casts = [
        'status' => \App\Enums\ArticleStatus::class,
        'published_at' => 'datetime'
    ];

    protected $with = ['user', 'category', 'tags'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('status', \App\Enums\ArticleStatus::PUBLISHED);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
