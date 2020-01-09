<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UseCase extends Model
{
    protected $table = 'useCases';

    protected $primaryKey = 'UseCaseIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offerIdx', 'useCaseDescription', 'useCaseContent'
    ];    

    public function offer(){
    	return $this->hasOne('App\Models\Offer');
    }
}
