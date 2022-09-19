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
        return $this->hasOne(Category::class, 'id');
    }

    public function tags()
    {
        return $this->hasManyThrough(Tags::class, TagAssigned::class, 'blog_id', 'id', 'id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id');
    }

    public function author()
    {
        return $this->hasOne(Author::class, 'id');
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
            $blog->tags()->delete();
        });
        self::deleted(function ($blog) {
            $blog->image()->delete();
        });
    }
}
