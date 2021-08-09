<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = ['product_variant_id', 'invoice_id', 'unit_price', 'quantity', 'color'];
    public function getProductVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}