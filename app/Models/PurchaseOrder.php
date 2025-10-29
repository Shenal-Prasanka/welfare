<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supply;


class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchaseorders'; // Table name

    protected $fillable = [
        'date',
        'welfare',
        'supply_id',
        'supplier_code',
        'items',
        'models',
        'quantities',
        'welfare_price',
        'welfare_total',
        'mrp',
        'mrp_total',
        'active',
    ];

    /**
     * Automatically cast JSON columns to arrays
     */
    protected $casts = [
        'items'         => 'array',
        'models'        => 'array',
        'quantities'    => 'array',
        'welfare_price' => 'array',
        'welfare_total' => 'array',
        'mrp'           => 'array',
        'mrp_total'     => 'array',
        'date'          => 'date',
    ];
    public function supply()
    {
        return $this->belongsTo(Supply::class, 'supply_id');
    }

}
