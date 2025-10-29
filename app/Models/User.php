<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Regement;
use App\Models\Rank;
use App\Models\Unit;
use App\Models\Welfare;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'employee_no',
        'regement_no',
        'regement_id',
        'unit_id',
        'rank_id',
        'email_verified_at',
        'active',
        'is_deleted',
        'password',
        'remember_token',
        'profile_image',
        'nic',
        'armyId',
        'officeAddress',
        'enlistedDate',
        'retireDate',
        'welfare_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function regement(){
         return $this->belongsTo(Regement::class, 'regement_id');
    }
  
    public function unit(){
         return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function welfare(){
         return $this->belongsTo(Welfare::class, 'welfare_id');
    }
  
    public function rank(){
         return $this->belongsTo(Rank::class, 'rank_id');
    }
    public function welfareloans()
    {
        return $this->hasMany(WelfareLoan::class, 'user_id');
    }


}
