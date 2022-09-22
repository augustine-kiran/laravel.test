<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    const AUTHOR_NAME = 'username';

    protected $hidden = ['author_id', 'category_id', 'image_id'];
    protected $appends = ['comments_count'];
    protected $fillable = ['title', 'content', 'author_id', 'category_id', 'image_id'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function tags()
    {
        return $this->hasManyThrough(Tags::class, TagAssigned::class, 'blog_id', 'id', 'id', 'tag_id');
    }

    public function tagsAssigned()
    {
        return $this->hasMany(TagAssigned::class, 'blog_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'blog_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getCommentsCountAttribute()
    {
        return count($this->comments);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($blog) {
            $blog->comments()->delete();
            $blog->tagsAssigned()->delete();
        });
        self::deleted(function ($blog) {
            $blog->image()->delete();
        });
    }
}
