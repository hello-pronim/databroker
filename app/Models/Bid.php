<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bids';

    protected $primaryKey = 'bidIdx';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bidIdx', 'userIdx', 'productIdx', 'bidPrice', 'bidMessage', 'bidResponse', 'bidStatus'
    ];
}
