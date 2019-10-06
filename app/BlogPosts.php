<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPosts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'user_id', 'flink', 'title', 'img', 'irdc', 'content', 'likes', 'status'
    ];
    
}
