<?php
namespace App\Services;

use App\Policies\CategoryPolicy;
use App\Policies\MenuPolicy;
use App\Policies\ProductPolicy;
use App\Policies\RolePolicy;
use App\Policies\SettingPolicy;
use App\Policies\SliderPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateSlider();
        $this->defineGateSetting();
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGateInvoice();
        Gate::define('permission_add', function ($user){
            return $user->checkPermissionAccess('permissionAdd');
        });
    }
    public function defineGateCategory()
    {
        Gate::define('category_list', [CategoryPolicy::class, 'view']);
        Gate::define('category_add', [CategoryPolicy::class, 'create']);
        Gate::define('category_edit', [CategoryPolicy::class, 'update']);
        Gate::define('category_delete', [CategoryPolicy::class, 'delete']);
    }

    public function defineGateMenu()
    {
        Gate::define('menu_list', [MenuPolicy::class, 'view']);
        Gate::define('menu_add', [MenuPolicy::class, 'create']);
        Gate::define('menu_edit', [MenuPolicy::class, 'update']);
        Gate::define('menu_delete', [MenuPolicy::class, 'delete']);
    }

    public function defineGateProduct()
    {
        Gate::define('product_list', [ProductPolicy::class, 'view']);
        Gate::define('product_add', [ProductPolicy::class, 'create']);
        Gate::define('product_edit', [ProductPolicy::class, 'update']);
        Gate::define('product_delete', [ProductPolicy::class, 'delete']);
    }

    public function defineGateSlider()
    {
        Gate::define('slider_list', [SliderPolicy::class, 'view']);
        Gate::define('slider_add', [SliderPolicy::class, 'create']);
        Gate::define('slider_edit', [SliderPolicy::class, 'update']);
        Gate::define('slider_delete', [SliderPolicy::class, 'delete']);
    }

    public function defineGateSetting()
    {
        Gate::define('setting_list', [SettingPolicy::class, 'view']);
        Gate::define('setting_add', [SettingPolicy::class, 'create']);
        Gate::define('setting_edit', [SettingPolicy::class, 'update']);
        Gate::define('setting_delete', [SettingPolicy::class, 'delete']);
    }

    public function defineGateUser()
    {
        Gate::define('user_list', [UserPolicy::class, 'view']);
        Gate::define('user_add', [UserPolicy::class, 'create']);
        Gate::define('user_edit', [UserPolicy::class, 'update']);
        Gate::define('user_delete', [UserPolicy::class, 'delete']);
    }

    public function defineGateRole()
    {
        Gate::define('role_list', [RolePolicy::class, 'view']);
        Gate::define('role_add', [RolePolicy::class, 'create']);
        Gate::define('role_edit', [RolePolicy::class, 'update']);
        Gate::define('role_delete', [RolePolicy::class, 'delete']);
    }
    public function defineGateInvoice()
    {
        Gate::define('invoice_list', [CategoryPolicy::class, 'view']);
        Gate::define('invoice_add', [CategoryPolicy::class, 'create']);
        Gate::define('invoice_edit', [CategoryPolicy::class, 'update']);
        Gate::define('invoice_delete', [CategoryPolicy::class, 'delete']);
    }

}
