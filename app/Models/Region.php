<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'regionIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'regionName', 'regionCheck', 'regionType'
    ];

    public function provider(){
        return $this->belongsTo('App\Models\Provider');
    }

    public function offercountry(){
        return $this->belongsTo('App\Models\OfferCountry');
    }
}
