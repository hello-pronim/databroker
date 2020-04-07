<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeaturedData extends Model
{
    protected $table = 'home_featured_data';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'featured_data_title',
        'featured_data_content',
        'featured_data_provider',
    ];
}
