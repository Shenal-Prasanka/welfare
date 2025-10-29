<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Rank extends Model
{
    use HasFactory;

    protected $table = 'ranks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rank',
        'type',
        'active',
        'is_deleted',
    ];

       public function users()
{
    return $this->hasMany(User::class, 'rank_id');
}

}