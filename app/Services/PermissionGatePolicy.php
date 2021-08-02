<?php


namespace App\Services;

use Illuminate\Support\Facades\Gate;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\VariantValuePolicy;
use App\Policies\MenuPolicy;
use App\Policies\SliderPolicy;
use App\Policies\SettingPolicy;
use App\Policies\PostCategoryPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\CheckAdminPolicy;

class PermissionGatePolicy
{
    public function setGateAndPolicy()
    {
        $this->setCategory();
        $this->setProduct();
        $this->setVariantValue();
        $this->setMenu();
        $this->setSlider();
        $this->setSetting();
        $this->setPostCategory();
        $this->setPost();
        $this->setUser();
        $this->setRole();
        $this->setAccessAdmin();
    }
    public function setAccessAdmin()
    {
        Gate::define('admin-access', [CheckAdminPolicy::class, 'checkRoleAdmin']);
    }
    public function setCategory()
    {
        Gate::define('category-list', [CategoryPolicy::class, 'viewAny']);
        Gate::define('category-add', [CategoryPolicy::class, 'create']);
        Gate::define('category-edit', [CategoryPolicy::class, 'update']);
        Gate::define('category-delete', [CategoryPolicy::class, 'delete']);
    }
    public function setProduct()
    {
        Gate::define('product-list', [ProductPolicy::class, 'viewAny']);
        Gate::define('product-add', [ProductPolicy::class, 'create']);
        Gate::define('product-edit', [ProductPolicy::class, 'update']);
        Gate::define('product-delete', [ProductPolicy::class, 'delete']);
    }
    public function setVariantValue()
    {
        Gate::define('variant-value-list', [VariantValuePolicy::class, 'viewAny']);
        Gate::define('variant-value-add', [VariantValuePolicy::class, 'create']);
        Gate::define('variant-value-edit', [VariantValuePolicy::class, 'update']);
        Gate::define('variant-value-delete', [VariantValuePolicy::class, 'delete']);
    }
    public function setMenu()
    {
        Gate::define('menu-list', [MenuPolicy::class, 'viewAny']);
        Gate::define('menu-add', [MenuPolicy::class, 'create']);
        Gate::define('menu-edit', [MenuPolicy::class, 'update']);
        Gate::define('menu-delete', [MenuPolicy::class, 'delete']);
    }
    public function setSlider()
    {
        Gate::define('slider-list', [SliderPolicy::class, 'viewAny']);
        Gate::define('slider-add', [SliderPolicy::class, 'create']);
        Gate::define('slider-edit', [SliderPolicy::class, 'update']);
        Gate::define('slider-delete', [SliderPolicy::class, 'delete']);
    }
    public function setSetting()
    {
        Gate::define('setting-list', [SettingPolicy::class, 'viewAny']);
        Gate::define('setting-add', [SettingPolicy::class, 'create']);
        Gate::define('setting-edit', [SettingPolicy::class, 'update']);
        Gate::define('setting-delete', [SettingPolicy::class, 'delete']);
    }
    public function setPostCategory()
    {
        Gate::define('post-category-list', [PostCategoryPolicy::class, 'viewAny']);
        Gate::define('post-category-add', [PostCategoryPolicy::class, 'create']);
        Gate::define('post-category-edit', [PostCategoryPolicy::class, 'update']);
        Gate::define('post-category-delete', [PostCategoryPolicy::class, 'delete']);
    }
    public function setPost()
    {
        Gate::define('post-list', [PostPolicy::class, 'viewAny']);
        Gate::define('post-add', [PostPolicy::class, 'create']);
        Gate::define('post-edit', [PostPolicy::class, 'update']);
        Gate::define('post-delete', [PostPolicy::class, 'delete']);
    }
    public function setUser()
    {
        Gate::define('user-list', [UserPolicy::class, 'viewAny']);
        Gate::define('user-add', [UserPolicy::class, 'create']);
        Gate::define('user-edit', [UserPolicy::class, 'update']);
        Gate::define('user-delete', [UserPolicy::class, 'delete']);
    }
    public function setRole()
    {
        Gate::define('role-list', [RolePolicy::class, 'viewAny']);
        Gate::define('role-add', [RolePolicy::class, 'create']);
        Gate::define('role-edit', [RolePolicy::class, 'update']);
        Gate::define('role-delete', [RolePolicy::class, 'delete']);
    }
}