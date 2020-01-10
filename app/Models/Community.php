<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $primaryKey = 'communityIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'communityName'
    ];

    public function offer(){
        return $this->belongsTo('App\Models\Offer');
    }
}