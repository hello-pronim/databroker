<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'saleIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchaseIdx', 'productIdx', 'sellerIdx', 'buyerIdx', 'bidIdx', 'from', 'to', 'redeemed_at', 'redeemed', 'transactionId'
    ];
}
