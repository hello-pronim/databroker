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
    	return $this->hasOne('App\Models\Community');
    }

    public function provider(){
    	return $this->hasOne('App\Models\Provider');
    }

    public function offersample(){
        return $this->belongsTo('App\Models\OfferSample');
    }    

    public function offercountry(){
        return $this->belongsTo('App\Models\OfferCountry');
    }    

    public function usecase(){
        return $this->belongsTo('App\Models\UseCase');
    }    

}
