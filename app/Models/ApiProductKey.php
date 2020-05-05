<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiProductKey extends Model
{
    protected $table = 'apiProductKeys';
    protected $primaryKey = 'apiProductKeyIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchaseIdx', 'apiKey'
    ];
    
}
