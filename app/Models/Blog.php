<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $hidden = ['author_id', 'category_id', 'image_id', 'tag_id'];
    protected $appends = ['author', 'category', 'image'];
    protected $fillable = ['title', 'content', 'author_id', 'category_id', 'image_id'];

    public function getAuthorAttribute()
    {
        return Author::find($this->author_id)->value('username');
    }

    public function getCategoryAttribute()
    {
        return Category::find($this->category_id)->value('name');
    }

    public function getImageAttribute()
    {
        return Image::find($this->image_id)->value('path');
    }
}
