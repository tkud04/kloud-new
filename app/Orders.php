<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'sd', 'user_id', 'reference', 'comment', 'total', 'status'
    ];
    
}