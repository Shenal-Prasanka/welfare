<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';

    protected $fillable = [
        'po_number',
        'welfare_id',
        'created_by',
        'approved_by',
        'rejected_by',
        'status',
        'approval_level',
        'rejection_reason',
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

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }

    public function welfare(): BelongsTo
    {
        return $this->belongsTo(Welfare::class);
    }

    public function supply(): BelongsTo
    {
        return $this->belongsTo(Supply::class, 'supply_id');
    }
}