<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = ['variant', 'type'];
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('variant', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getVariantValue()
    {
        return $this->hasMany(VariantValue::class, 'variant_id', 'id');
    }
}