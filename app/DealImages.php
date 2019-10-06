<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealImages extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku', 'url', 'irdc'
    ];
    
}
