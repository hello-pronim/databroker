<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkedUser extends Model
{
    protected $table = 'linked_users';

    protected $primaryKey = 'linkedIdx';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'linkedIdx', 'invite_userIdx', 'linked_email'
    ];
}
