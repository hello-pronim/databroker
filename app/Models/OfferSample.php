<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferSample extends Model
{
    protected $table = 'offerSamples';

    protected $primaryKey = 'sampleIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offerIdx', 'sampleDescription', 'sampleFileName', 'sampleType'
    ];    

    public function offer(){
    	return $this->hasMany('App\Models\Offer', 'offerIdx', 'offerIdx');
    }

}
