<?php


use Illuminate\Support\Facades\Route;



Route::get('/admin', 'App\Http\Controllers\AdminController@login');
Route::post('/admin', 'App\Http\Controllers\AdminController@postlogin');


Route::post('logout', 'App\Http\Controllers\AdminController@logout')->name('logout');

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoriesController@create',
            'middleware'=>'can:category_add'
        ]);
        Route::get('/',[
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoriesController@index',
            'middleware'=>'can:category_list'
        ]);
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoriesController@store'
        ]);
        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoriesController@update'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoriesController@edit',
            'middleware'=>'can:category_edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoriesController@delete',
            'middleware'=>'can:category_delete'
        ]);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/',[
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware'=>'can:menu_list'
        ]);
        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware'=>'can:menu_add'
        ]);
        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware'=>'can:menu_edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete',
            'middleware'=>'can:menu_delete'
        ]);
    });

    // Product
    Route::prefix('product')->group(function () {
        Route::get('/',[
            'as' => 'product.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware'=>'can:product_list'
        ]);
        Route::get('/create',[
            'as' => 'product.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
            'middleware'=>'can:product_add'
        ]);
        Route::post('/store',[
            'as' => 'product.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'product.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
            'middleware'=>'can:product_edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'product.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'product.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete',
            'middleware'=>'can:product_delete'
        ]);
    });

    // Slider
    Route::prefix('slider')->group(function () {
        Route::get('/',[
            'as' => 'slider.index',
            'uses' => 'App\Http\Controllers\AdminSliderController@index',
            'middleware'=>'can:slider_list'
        ]);
        Route::get('/create',[
            'as' => 'slider.create',
            'uses' => 'App\Http\Controllers\AdminSliderController@create',
            'middleware'=>'can:slider_add'
        ]);
        Route::post('/store',[
            'as' => 'slider.store',
            'uses' => 'App\Http\Controllers\AdminSliderController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'slider.edit',
            'uses' => 'App\Http\Controllers\AdminSliderController@edit',
            'middleware'=>'can:slider_edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'slider.update',
            'uses' => 'App\Http\Controllers\AdminSliderController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'slider.delete',
            'uses' => 'App\Http\Controllers\AdminSliderController@delete',
            'middleware'=>'can:slider_delete'
        ]);
    });

    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/',[
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index',
            'middleware'=>'can:setting_list'
        ]);
        Route::get('/create',[
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create',
            'middleware'=>'can:setting_add'
        ]);
        Route::post('/store',[
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit',
            'middleware'=>'can:setting_edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete',
            'middleware'=>'can:setting_delete'
        ]);
    });

    // User
    Route::prefix('users')->group(function () {
        Route::get('/',[
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index',
            'middleware'=>'can:user_list'
        ]);
        Route::get('/create',[
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create',
            'middleware'=>'can:user_add'
        ]);
        Route::post('/store',[
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit',
            'middleware'=>'can:user_edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\AdminUserController@delete',
            'middleware'=>'can:user_delete'
        ]);
    });

    // Role
    Route::prefix('roles')->group(function () {
        Route::get('/',[
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\AdminRoleController@index',
            'middleware'=>'can:role_list'
        ]);
        Route::get('/create',[
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\AdminRoleController@create',
            'middleware'=>'can:role_add'
        ]);
        Route::post('/store',[
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit',
            'middleware'=>'can:role_edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'roles.delete',
            'uses' => 'App\Http\Controllers\AdminRoleController@delete',
            'middleware'=>'can:role_delete'
        ]);
    });

    Route::prefix('invoices')->group(function () {
        Route::get('/',[
            'as' => 'invoices.index',
            'uses' => 'App\Http\Controllers\AdminInvoiceController@index',
            'middleware'=>'can:invoice_list'
        ]);

    });

    // Permissions
    Route::prefix('permissions')->group(function () {
        Route::get('/create',[
            'as' => 'permissions.create',
            'uses' => 'App\Http\Controllers\AdminPermissionController@createPermission',
//            'middleware'=>'can:permission_add'
        ]);
        Route::post('/store',[
            'as' => 'permissions.store',
            'uses' => 'App\Http\Controllers\AdminPermissionController@store'
        ]);
    });

    //Đơn hàng

    Route::post('/orders/{id}/confirm', [\App\Http\Controllers\AdminInvoiceController::class, 'confirm'])->name('orders.confirm');
    Route::post('/orders/{id}/cancel', [\App\Http\Controllers\AdminInvoiceController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/{id}', [\App\Http\Controllers\AdminInvoiceController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/update-status', [\App\Http\Controllers\AdminInvoiceController::class, 'updateStatus'])->name('orders.update.status');
//Thong ke

    Route::get('/home', [\App\Http\Controllers\RevenueController::class, 'index'])->name('home');


});




