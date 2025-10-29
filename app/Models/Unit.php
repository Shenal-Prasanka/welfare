<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Regement;
use App\Models\User;

class Unit extends Model
{
     use HasFactory;

    
    protected $fillable = [
        'regement_id',
        'unit',
        'active',
        'is_deleted',
    ];
    public function regement()
    {
        return $this->belongsTo(Regement::class, 'regement_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'unit_id');
    }

}
