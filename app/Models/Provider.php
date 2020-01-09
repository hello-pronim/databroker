<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $primaryKey = 'providerIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userIdx', 'regionIdx', 'companyName', 'companyURL', 'companyLogo'
    ];

    public function user(){
    	return $this->hasOne('App\User');
    }

    public function region(){
    	return $this->hasOne('App\Models\Region');
    }

    public function offer(){
        return $this->belongsTo('App\Models\Offer');
    }    
}
