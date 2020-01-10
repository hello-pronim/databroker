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
        'regionIdx', 'offerIdx'
    ];    
	
}
