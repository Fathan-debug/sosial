<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'caption', 'image'];

    // A post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post can have many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // A post can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
