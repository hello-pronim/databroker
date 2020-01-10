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
    	return $this->hasOne('App\Models\Provider', 'providerIdx', 'providerIdx');
    }

}
