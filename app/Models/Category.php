<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'slug', 'image', 'status'];
    use HasFactory, SoftDeletes;

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getProduct()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}