<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionProduct extends Model
{
    protected $table = 'regionProducts';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'regionIdx', 'productIdx'
    ];
}
