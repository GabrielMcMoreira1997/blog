<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostContent extends Model
{
    protected $table = 'post_content';
    protected $primaryKey = 'post_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'content',
        'image',
        'video'
    ];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
