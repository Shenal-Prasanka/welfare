<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'membership_date',
        'army_id',
        'regiment_no',
        'nic',
        'active',
        'is_deleted',
    ];
    protected $casts = [
        'membership_date' => 'date'
    ];
}