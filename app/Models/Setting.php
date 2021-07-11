<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['config_key', 'config_value', 'type'];
    use HasFactory;
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('config_key', 'like', '%' . $key . '%');
        }
        return $query;
    }
}