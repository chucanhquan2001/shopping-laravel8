<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    protected $fillable = ['name', 'slug', 'price', 'discount', 'quantity', 'image', 'content', 'description', 'status', 'view', 'total_product_sold', 'category_id', 'user_id'];
    use HasFactory, softDeletes;

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getProductVariant()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    public function getTag()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
    public function getCate()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
}