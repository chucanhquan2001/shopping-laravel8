<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'rating_star', 'comment', 'status', 'product_id'];
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getReplies()
    {
        return $this->hasMany(Reply::class, 'review_id', 'id');
    }

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}