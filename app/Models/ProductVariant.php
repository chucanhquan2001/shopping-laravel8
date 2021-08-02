<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['quantity', 'image', 'discount', 'price', 'sku', 'status', 'product_id'];
    public function getVariantValues()
    {
        return $this->belongsToMany(VariantValue::class, 'product_details', 'product_variant_id', 'variant_value_id')->withTimestamps();
    }

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}