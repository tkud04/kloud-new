<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auction_id', 'size', 'color', 'qty', 'user_id', 'amount','pay','status'
    ];
    
}
