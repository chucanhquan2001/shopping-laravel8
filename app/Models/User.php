<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
    ];

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // phương thức trung gian với bảng roles
    public function getRoles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')->withTimestamps();
    }

    public function getProduct()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    // check quyền
    public function checkPermission($key_code)
    {
        // lấy tất cả các quyền của user đang login vào hệ thống
        $roles = Auth::user()->getRoles;
        foreach ($roles as $role) {
            $permissions = $role->getPermissions;
            if ($permissions->contains('key_code', $key_code)) {
                return true;
            }
        }
        return false;
        // so sánh giá trị đưa vào của route xem có tồn tại trong những quyền của user không
    }
}