<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deal_id', 'user_id', 'stars', 'status'
    ];
    
}
