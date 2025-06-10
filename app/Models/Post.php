<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = [
        'title',
        'description',
        'author',
        'slug',
        'image',
        'status',
        'created_at',
        'updated_at',
        'published_at',
        'categories',
        'tags'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(PostComments::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'post_category');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function content()
    {
        return $this->hasMany(PostContent::class);
    }
}
