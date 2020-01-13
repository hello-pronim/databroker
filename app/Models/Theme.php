<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $primaryKey = 'themeIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'themeIdx', 'themeName'
    ];
 	

 	 public function offer(){
    	return $this->belongsToMany('App\Models\Offer', 'App\Models\OfferTheme', 'themeIdx', 'offerIdx');
    }   
}
