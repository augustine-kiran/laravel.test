<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'blog_id', 'author_id'];
    protected $fillable = ['blog_id', 'comment', 'author_id'];
    protected $appends = ['author'];

    public function getAuthorAttribute()
    {
        return Author::where('id', $this->author_id)->value('username');
    }
}
