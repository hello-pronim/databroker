<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTeamPicks extends Model
{
    protected $table = 'home_teampicks';

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
        'published',
        'logo_url'
    ];

    protected $casts = [
        'published' => 'date',
    ];

}
