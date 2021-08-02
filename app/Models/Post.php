<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'meta_description', 'content', 'image', 'status', 'view', 'post_category_id'];
    use HasFactory, SoftDeletes;
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('title', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}