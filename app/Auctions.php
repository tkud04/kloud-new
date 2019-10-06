<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auctions extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'deal_id', 'auction_price', 'buy_price', 'hb', 'category', 'days', 'hours', 'minutes', 'status','bids',
    ];
    
}
