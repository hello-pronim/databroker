<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'companyIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userIdx', 'regionIdx', 'companyName', 'companyURL', 'companyLogo'
    ];

    public function user(){
    	return $this->hasOne('App\User', 'userIdx', 'userIdx');
    }

    public function region(){
    	return $this->hasOne('App\Models\Region', 'regionIdx', 'regionIdx');
    }
}
