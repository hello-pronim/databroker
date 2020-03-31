<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaidProduct extends Model
{
    protected $table = 'paidProducts';
    protected $primaryKey = 'paidProductIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productIdx', 'userIdx', 'bidIdx', 'from', 'to'
    ];
}
