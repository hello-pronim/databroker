<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complaint extends Model
{
    //
    protected $table = 'complaints';
    protected $primaryKey = 'complaintIdx';

    protected $fillable = [
        'userIdx', 'complaintTarget', 'complaintKind', 'complaintContent'
    ];
}
