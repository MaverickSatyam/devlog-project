<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Add this to fillable
    protected $fillable = ['title', 'content', 'image', 'is_published', 'user_id'];

    // Add the relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
