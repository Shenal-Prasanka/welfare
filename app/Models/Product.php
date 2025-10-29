<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Category;
use App\Models\productsupply;
use App\Models\Stockapprove;
use App\Models\Pricelist;


class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_number',
        'product',
        'category_id',
        'normal_price',
        'vat',
        'tax',
        'welfare_price', 
        'active',
        'is_delete',
    ];

    public function items()
    {
    return $this->hasMany(Item::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productsupply()
    {
        return $this->hasMany(productsupply::class, 'product_id');
    }

    public function stockapprove()
    {
        return $this->hasMany(Stockapprove::class, 'product_id');
    }

    public function pricelists()
    {
        return $this->hasMany(Pricelist::class, 'product_id');
    }

     // Auto-generate loan_number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $lastProduct = Product::orderBy('id', 'desc')->first();
            $nextNumber = $lastProduct ? ((int) str_replace('PT-', '', $lastProduct->product_number)) + 1 : 1;
            $product->product_number = 'PT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
