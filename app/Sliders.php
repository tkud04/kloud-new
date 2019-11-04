<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Sliders extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subtitle', 'title', 'cta_1', 'cta_2', 'tag', 'copy', 'img', 'type'
    ];
    
}