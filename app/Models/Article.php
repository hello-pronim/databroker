<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $primaryKey = 'articleIdx';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'articleIdx',
        'communityIdx',
        'articleTitle',
        'articleContent',
        'image',
        'author',
        'link',
        'published',
    ];

    protected $casts = [
        'published' => 'date',
    ];
    
    public function community(){
    	return $this->hasOne('App\Models\Community', 'communityIdx', 'communityIdx');
    }

}
