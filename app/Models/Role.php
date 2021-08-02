<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'display_name'];
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    public function getPermissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id')->withTimestamps();
    }
}