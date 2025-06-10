<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $fillable = [
        'post_id',
        'comment',
        'author',
        'created_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
