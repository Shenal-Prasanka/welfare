<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrder;
use App\Models\Stockapprove;


class Supply extends Model
{
   use HasFactory;
    
    protected $table = 'supplys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supply_number',   
        'supply',
        'description',
        'active',
        'is_deleted',
    ];

    public function purchaseorder()
    {
        return $this->hasMany(PurchaseOrder::class, 'supply_id');
    }

    public function stockapprove()
    {
        return $this->hasMany(Stockapprove::class, 'supply_id');
    }

// Auto-generate loan_number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supply) {
            $lastSupply = Supply::orderBy('id', 'desc')->first();
            $nextNumber = $lastSupply ? ((int) str_replace('ST-', '', $lastSupply->supply_number)) + 1 : 1;
            $supply->supply_number = 'ST-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
