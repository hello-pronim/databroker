<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $primaryKey = 'offerIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'communityIdx', 'providerIdx', 'offerTitle', 'offerImage', 'offerDescription'
    ];    

    public function community(){
    	return $this->hasOne('App\Models\Community', 'communityIdx', 'communityIdx');
    }

    public function provider(){
    	return $this->hasOne('App\Models\Provider', 'providerIdx', 'providerIdx');
    }

    public function usecase(){
    	return $this->belongsTo('App\Models\UseCase', 'offerIdx', 'offerIdx');
    }

    public function region(){
    	return $this->belongsToMany('App\Models\Region', 'App\Models\OfferCountry', 'offerIdx', 'regionIdx');
    }

}
