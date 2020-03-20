<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    //
    protected $primaryKey = 'subscriptionIdx';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'companyName', 'regionIdx', 'role', 'businessName', 'communities', 'message'
    ];
}
