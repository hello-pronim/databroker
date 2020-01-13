<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferTheme extends Model
{
    protected $table = 'offerThemes';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'themeIdx', 'offerIdx'
    ];    
	
}
