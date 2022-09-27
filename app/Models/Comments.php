<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    const AUTHOR_NAME = 'name';

    protected $hidden = ['id', 'blog_id', 'user_id'];
    protected $fillable = ['blog_id', 'comment', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
