<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagAssigned extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'blog_id'];
    protected $hidden = ['id', 'tag_id', 'blog_id'];
}
