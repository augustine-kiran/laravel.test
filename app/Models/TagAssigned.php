<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagAssigned extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'blog_id'];
    protected $appends = ['tag_name'];
    protected $hidden = ['id', 'tag_id', 'blog_id'];

    public function getTagNameAttribute()
    {
        return Tags::where('id', $this->tag_id)->value('name');
    }
}
