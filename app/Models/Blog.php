<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    const AUTHOR_NAME = 'name';

    protected $hidden = ['user_id', 'category_id'];
    protected $appends = ['comments_count'];
    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->using(BlogTag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comments::class)->orderBy('id', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
            $blog->tags()->detach();
        });
    }
}
