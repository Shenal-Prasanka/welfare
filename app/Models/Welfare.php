<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;
use App\Models\WelfareLoan;
use App\Models\productsupply;
use App\Models\Stockapprove;


class Welfare extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'welfare_number',
        'name',
        'location',
        'active',
        'delete',
    ];

    public function welfareloans()
    {
        return $this->hasMany(WelfareLoan::class, 'welfare_id');
    }

    public function productsupply()
    {
        return $this->hasMany(productsupply::class, 'welfare_id');
    }

    public function stockapprove()
    {
        return $this->hasMany(Stockapprove::class, 'welfare_id');
    }

     public function users()
    {
        return $this->hasMany(User::class, 'welfare_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'welfare_id');
    }
 

     // Auto-generate loan_number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($welfare) {
            $lastwelfare = Welfare::orderBy('id', 'desc')->first();
            $nextNumber = $lastwelfare ? ((int) str_replace('WT-', '', $lastwelfare->welfare_number)) + 1 : 1;
            $welfare->welfare_number = 'WT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
