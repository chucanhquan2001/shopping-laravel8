<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['comment', 'status', 'user_id', 'review_id'];
    use HasFactory;
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('comment', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getReview()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}