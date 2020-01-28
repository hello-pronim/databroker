<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    protected $table = 'offerProducts';

    protected $primaryKey = 'productIdx';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productIdx', 'offerIdx', 'productType', 'productTitle', 'productMoreInfo', 'productAccessDays', 'productBidType', 'productPrice', 'productInstruction', 'productStatus', 'productLicenseUrl'
    ];    

}