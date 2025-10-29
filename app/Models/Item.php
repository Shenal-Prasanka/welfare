<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Welfare;

class Item extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'product_id',
        'welfare_id',
        'serial_number',
        'added_date',
        'issued_date',
        'active',

    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function welfare()
    {
        return $this->belongsTo(Welfare::class, 'welfare_id');
    }
}
