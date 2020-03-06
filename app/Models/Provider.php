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
        'userIdx', 'regionIdx', 'companyName', 'companyURL', 'companyLogo', 'companyVAT'
    ];

    public function user(){
    	return $this->hasOne('App\User', 'userIdx', 'userIdx');
    }

    public function region(){
    	return $this->hasOne('App\Models\Region', 'regionIdx', 'regionIdx');
    }
    
}
