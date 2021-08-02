<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;
    protected $fillable = ['value', 'variant_id'];
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('value', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getVariant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}