<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $fillable = ['name', 'slug', 'status'];
    use HasFactory, SoftDeletes;
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getPost()
    {
        return $this->hasMany(Post::class, 'post_category_id', 'id');
    }
}