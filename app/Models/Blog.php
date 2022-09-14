<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $hidden = ['author_id', 'category_id', 'image_id'];
    protected $appends = ['author', 'category', 'image'];
    protected $fillable = ['title', 'content', 'author_id', 'category_id', 'image_id'];

    public function getAuthorAttribute()
    {
        return Author::where('id', $this->author_id)->value('username');
    }

    public function getCategoryAttribute()
    {
        return Category::where('id', $this->category_id)->value('name');
    }

    public function getImageAttribute()
    {
        return Image::where('id', $this->image_id)->value('path');
    }

    public function getTagsAttribute()
    {
        return TagAssigned::where('blog_id', $this->id)->first();
    }
}
