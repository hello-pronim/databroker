<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdatesCategories extends Model
{
    protected $table = 'updatesCategories';
    protected $primaryKey = 'categoryIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];
}
