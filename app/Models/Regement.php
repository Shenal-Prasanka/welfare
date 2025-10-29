<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;
use App\Models\User;

class Regement extends Model
{
     use HasFactory;


    protected $fillable = [
        'regement',
        'active',
        'is_deleted',
    ];

    public function units()
{
    return $this->hasMany(Unit::class, 'regement_id');
}

    public function users()
{
    return $this->hasMany(User::class, 'regement_id');
}


}
