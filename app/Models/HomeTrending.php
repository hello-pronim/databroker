<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTrending extends Model
{
    protected $table = 'home_trending';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'title',
        'image',
        'order',
        'logo_url',
        'active'
    ];
}
