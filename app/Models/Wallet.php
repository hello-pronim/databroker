<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    //
    protected $table = 'wallets';
    protected $primaryKey = 'walletIdx';

    protected $fillable = [
        'userIdx', 'walletAddress'
    ];
}
