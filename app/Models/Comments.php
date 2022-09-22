<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'blog_id', 'user_id'];
    protected $fillable = ['blog_id', 'comment', 'user_id'];
    protected $appends = ['days_ago'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getDaysAgoAttribute()
    {
        $output = '';
        if (!empty($this->created_at)) {
            $timeInMinutes = $this->created_at->diffInMinutes(now());
            $output = ($timeInMinutes / 24 / 60 > 0) ? ($timeInMinutes / 24 / 60) . ' day(s) ' : '';
            $output = ($timeInMinutes / 60 % 24 > 0) ? ($timeInMinutes / 60 % 24) . ' hour(s) ' : '';
            $output = ($timeInMinutes % 60 > 0) ? ($timeInMinutes % 60) . ' min(s) ' : '';
        }

        return empty($output) ? 'Just now' : $output . 'ago';
    }
}
