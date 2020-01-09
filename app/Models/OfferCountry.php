<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCountry extends Model
{
    
    protected $table = 'offerCountries';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offerIdx', 'regionIdx'
    ];    

	public function offer(){
    	return $this->hasOne('App\Models\Offer');
    }

    public function region(){
    	return $this->hasOne('App\Models\Region');
    }
}
