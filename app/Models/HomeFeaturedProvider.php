<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeaturedProvider extends Model
{
    protected $table = 'home_featured_provider';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'providerIdx',
        'order'
    ];

}
