<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transactionId', 'transactionType', 'userIdx', 'senderIdx', 'receiverIdx', 'productIdx', 'amount', 'status'
    ];
    
}
