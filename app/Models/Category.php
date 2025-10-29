<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Item;
use App\Models\Pricelist;

class Category extends Model
{
     use HasFactory;
    
    protected $table = 'categorys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category',
        'description',
        'active',
        'is_deleted',
    ];

     public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

     public function pricelists()
    {
        return $this->hasMany(Pricelist::class, 'category_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
