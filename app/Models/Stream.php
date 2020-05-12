<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $table = 'streams';
    protected $primaryKey = 'streamIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userIdx', 'purchaseIdx', 'IP', 'port'
    ];
    
}
