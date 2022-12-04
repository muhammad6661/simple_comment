<?php

namespace App\Models;

use App\Casts\PostDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'image', 'created_at'];

    protected $casts = [
        'created_at' => PostDateCast::class,
    ];

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
