<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeMarketplace extends Model
{
    protected $table = 'home_marketplace';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'title',
        'content',
        'meta_title',
        'meta_desc',
        'logo',
        'legion',
        'image',
        'order',
        'logo_url',
        'active'
    ];
}
