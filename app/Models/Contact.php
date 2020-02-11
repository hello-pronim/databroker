<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    //
    protected $primaryKey = 'contactIdx';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'companyName', 'jobTitle', 'content'
    ];
}
