<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_nr', 'phone', 'name', 'address', 'email', 'note', 'total_price', 'user_id', 'user_id_admin', 'status'];
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('invoice_nr', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getInvoices()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }

    public function getProductVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'invoice_details', 'invoice_id', 'product_variant_id')->withTimestamps();
    }

    public function getUserAdmin()
    {
        return $this->belongsTo(User::class, 'user_id_admin');
    }
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}