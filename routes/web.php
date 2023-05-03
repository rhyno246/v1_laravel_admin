<?php

use Illuminate\Support\Facades\Route;




//backend
Route::get('/admin',  'App\Http\Controllers\AdminLoginController@login');
Route::post('/admin', [
    'as' => 'admin.login',
    'uses' => 'App\Http\Controllers\AdminLoginController@PostLogin',
]);
Route::get('/logout', [
    'as' => 'admin.logout',
    'uses' => 'App\Http\Controllers\AdminLoginController@logout'
]);
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [
        'as' => 'backend.dashboard',
        'uses' => 'App\Http\Controllers\AdminDashBoardController@index',
        'middleware' => ('CheckIsUser')
    ]);

    //product category
    Route::prefix('product-category')->group(function () {
        Route::get('/', [
            'as' => 'category.product.index',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@index',
            'middleware' => (['CheckIsUser', 'can:gate-category-view'])
        ]);
        Route::get('/create', [
            'as' => 'category.product.create',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@create',
            'middleware' => (['CheckIsUser', 'can:gate-category-view'])
        ]);
        Route::post('/store', [
            'as' => 'category.product.store',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@store',
            'middleware' => (['CheckIsUser', 'can:gate-category-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'category.product.edit',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-category-update'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'category.product.update',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@update',
            'middleware' => (['CheckIsUser', 'can:gate-category-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'category.product.detele',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-category-delete'])
        ]);

        Route::post('/seleted-category', [
            'as' => 'category.product.seletedeleted',
            'uses' => 'App\Http\Controllers\AdminProductCategoryController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-category-delete'])
        ]);
    });






    //post category
    Route::prefix('post-category')->group(function () {
        Route::get('/', [
            'as' => 'category.post.index',
            'uses' => 'App\Http\Controllers\AdminPostCategory@index',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-view'])
        ]);
        Route::get('/create', [
            'as' => 'category.post.create',
            'uses' => 'App\Http\Controllers\AdminPostCategory@create',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-view'])
        ]);
        Route::post('/store', [
            'as' => 'category.post.store',
            'uses' => 'App\Http\Controllers\AdminPostCategory@store',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'category.post.edit',
            'uses' => 'App\Http\Controllers\AdminPostCategory@edit',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'category.post.update',
            'uses' => 'App\Http\Controllers\AdminPostCategory@update',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-update'])
        ]);

        Route::get('/delete/{id}', [
            'as' => 'category.post.detele',
            'uses' => 'App\Http\Controllers\AdminPostCategory@delete',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-delete'])
        ]);

        Route::post('/seleted-category', [
            'as' => 'category.post.seletedeleted',
            'uses' => 'App\Http\Controllers\AdminPostCategory@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-post-category-delete'])
        ]);
    });






    //permissions
    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'App\Http\Controllers\AdminPermissionController@create',
            'middleware' => (['CheckIsUser', 'can:gate-permissions-view'])
        ]);
        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'App\Http\Controllers\AdminPermissionController@store',
            'middleware' => (['CheckIsUser', 'can:gate-permissions-create'])
        ]);
    });


    //menu
    Route::prefix('menu')->group(function () {
        Route::get('/', [
            'as' => 'menu.index',
            'uses' => 'App\Http\Controllers\AdminMenuController@index',
            'middleware' => (['CheckIsUser', 'can:gate-menu-view'])
        ]);
        Route::get('/create', [
            'as' => 'menu.create',
            'uses' => 'App\Http\Controllers\AdminMenuController@create',
            'middleware' => (['CheckIsUser', 'can:gate-menu-view'])
        ]);
        Route::post('/store', [
            'as' => 'menu.store',
            'uses' => 'App\Http\Controllers\AdminMenuController@store',
            'middleware' => (['CheckIsUser', 'can:gate-menu-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menu.edit',
            'uses' => 'App\Http\Controllers\AdminMenuController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-menu-view'])
        ]);

        Route::post('/update/{id}', [
            'as' => 'menu.update',
            'uses' => 'App\Http\Controllers\AdminMenuController@update',
            'middleware' => (['CheckIsUser', 'can:gate-menu-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menu.delete',
            'uses' => 'App\Http\Controllers\AdminMenuController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-menu-delete'])
        ]);

        Route::post('/seleted-menu', [
            'as' => 'menu.seletedeleted',
            'uses' => 'App\Http\Controllers\AdminMenuController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-menu-delete'])
        ]);
    });



    //roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'role.index',
            'uses' => 'App\Http\Controllers\AdminRoleController@index',
            'middleware' => (['CheckIsUser', 'can:gate-role-view'])
        ]);
        Route::get('/create', [
            'as' => 'role.create',
            'uses' => 'App\Http\Controllers\AdminRoleController@create',
            'middleware' => (['CheckIsUser', 'can:gate-role-view'])
        ]);
        Route::post('/store', [
            'as' => 'role.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store',
            'middleware' => (['CheckIsUser', 'can:gate-role-create'])
        ]);

        Route::get('/edit/{id}', [
            'as' => 'role.edit',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-role-update'])
        ]);

        Route::post('/update/{id}', [
            'as' => 'role.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update',
            'middleware' => (['CheckIsUser', 'can:gate-role-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'role.delete',
            'uses' => 'App\Http\Controllers\AdminRoleController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-role-delete'])
        ]);
        Route::post('/seleted-roles', [
            'as' => 'role.deleteselect',
            'uses' => 'App\Http\Controllers\AdminRoleController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-role-delete'])
        ]);
    });


    //settings
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index',
            'middleware' => (['CheckIsUser', 'can:gate-settings-view'])
        ]);
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create',
            'middleware' => (['CheckIsUser', 'can:gate-settings-view'])
        ]);

        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store',
            'middleware' => (['CheckIsUser', 'can:gate-settings-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-settings-update'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update',
            'middleware' => (['CheckIsUser', 'can:gate-settings-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-settings-delete'])
        ]);
        Route::post('/seleted-settings', [
            'as' => 'settings.deleteselect',
            'uses' => 'App\Http\Controllers\AdminSettingController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-settings-delete'])
        ]);
    });


    //post
    Route::prefix('posts')->group(function () {
        Route::get('/', [
            'as' => 'post.index',
            'uses' => 'App\Http\Controllers\AdminPostController@index',
            'middleware' => (['CheckIsUser', 'can:gate-post-view'])
        ]);
        Route::get('/create', [
            'as' => 'post.create',
            'uses' => 'App\Http\Controllers\AdminPostController@create',
            'middleware' => (['CheckIsUser', 'can:gate-post-view'])
        ]);
        Route::post('/store', [
            'as' => 'post.store',
            'uses' => 'App\Http\Controllers\AdminPostController@store',
            'middleware' => (['CheckIsUser', 'can:gate-post-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'post.edit',
            'uses' => 'App\Http\Controllers\AdminPostController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-post-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'post.update',
            'uses' => 'App\Http\Controllers\AdminPostController@update',
            'middleware' => (['CheckIsUser', 'can:gate-post-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'post.delete',
            'uses' => 'App\Http\Controllers\AdminPostController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-post-delete'])
        ]);

        Route::post('/seleted-post', [
            'as' => 'post.deleteselect',
            'uses' => 'App\Http\Controllers\AdminPostController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-post-delete'])
        ]);


        Route::get('/status-home/{id}', [
            'as' => 'post.statushome',
            'uses' => 'App\Http\Controllers\AdminPostController@changeStatusHome',
            'middleware' => (['CheckIsUser', 'can:gate-post-update'])
        ]);

        Route::get('/status-product/{id}', [
            'as' => 'post.statusproduct',
            'uses' => 'App\Http\Controllers\AdminPostController@changeStatusShow',
            'middleware' => (['CheckIsUser', 'can:gate-post-update'])
        ]);
    });



    Route::prefix('post-tags')->group(function () {
        Route::get('/', [
            'as' => 'tags.post.index',
            'uses' => 'App\Http\Controllers\AdminPostTags@index',
            'middleware' => (['CheckIsUser', 'can:gate-post-tags-view'])
        ]);
        Route::get('/create', [
            'as' => 'tags.post.create',
            'uses' => 'App\Http\Controllers\AdminPostTags@create',
            'middleware' => (['CheckIsUser', 'can:gate-post-tags-view'])
        ]);
        Route::post('/store', [
            'as' => 'tags.post.store',
            'uses' => 'App\Http\Controllers\AdminPostTags@store',
            'middleware' => (['CheckIsUser', 'can:gate-post-tags-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'tags.post.edit',
            'uses' => 'App\Http\Controllers\AdminPostTags@edit',
            'middleware' => (['CheckIsUser'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'tags.post.update',
            'uses' => 'App\Http\Controllers\AdminPostTags@update',
            'middleware' => (['CheckIsUser', 'can:gate-post-tags-update'])
        ]);

        Route::get('/delete/{id}', [
            'as' => 'tags.post.detele',
            'uses' => 'App\Http\Controllers\AdminPostTags@delete',
            'middleware' => (['CheckIsUser', 'can:gate-post-tags-delete'])
        ]);

        Route::post('/seleted-tags', [
            'as' => 'tags.post.seletedeleted',
            'uses' => 'App\Http\Controllers\AdminPostTags@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-post-tags-delete'])
        ]);
    });






    //product tags
    Route::prefix('product-tags')->group(function () {
        Route::get('/', [
            'as' => 'tags.product.index',
            'uses' => 'App\Http\Controllers\AdminProductTags@index',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-view'])
        ]);
        Route::get('/create', [
            'as' => 'tags.product.create',
            'uses' => 'App\Http\Controllers\AdminProductTags@create',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-view'])
        ]);
        Route::post('/store', [
            'as' => 'tags.product.store',
            'uses' => 'App\Http\Controllers\AdminProductTags@store',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'tags.product.edit',
            'uses' => 'App\Http\Controllers\AdminProductTags@edit',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'tags.product.update',
            'uses' => 'App\Http\Controllers\AdminProductTags@update',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-update'])
        ]);

        Route::get('/delete/{id}', [
            'as' => 'tags.product.detele',
            'uses' => 'App\Http\Controllers\AdminProductTags@delete',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-delete'])
        ]);

        Route::post('/seleted-tags', [
            'as' => 'tags.product.seletedeleted',
            'uses' => 'App\Http\Controllers\AdminProductTags@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-products-tags-delete'])
        ]);
    });



    //slider
    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' => 'slider.index',
            'uses' => 'App\Http\Controllers\AdminSliderController@index',
            'middleware' => (['CheckIsUser', 'can:gate-slider-view'])
        ]);
        Route::get('/create', [
            'as' => 'slider.create',
            'uses' => 'App\Http\Controllers\AdminSliderController@create',
            'middleware' => (['CheckIsUser', 'can:gate-slider-view'])
        ]);
        Route::post('/store', [
            'as' => 'slider.store',
            'uses' => 'App\Http\Controllers\AdminSliderController@store',
            'middleware' => (['CheckIsUser', 'can:gate-slider-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'slider.edit',
            'uses' => 'App\Http\Controllers\AdminSliderController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-slider-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'slider.update',
            'uses' => 'App\Http\Controllers\AdminSliderController@update',
            'middleware' => (['CheckIsUser', 'can:gate-slider-update'])
        ]);

        Route::get('/delete/{id}', [
            'as' => 'slider.detele',
            'uses' => 'App\Http\Controllers\AdminSliderController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-slider-delete'])
        ]);

        Route::post('/seleted-slider', [
            'as' => 'slider.seletedeleted',
            'uses' => 'App\Http\Controllers\AdminSliderController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-slider-delete'])
        ]);
    });




    //product 
    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware' => (['CheckIsUser', 'can:gate-products-view'])
        ]);
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
            'middleware' => (['CheckIsUser', 'can:gate-products-view'])
        ]);
        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store',
            'middleware' => (['CheckIsUser', 'can:gate-products-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-products-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update',
            'middleware' => (['CheckIsUser', 'can:gate-products-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-products-delete'])
        ]);

        Route::post('/seleted-post', [
            'as' => 'products.deleteselect',
            'uses' => 'App\Http\Controllers\AdminProductController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-products-delete'])
        ]);


        Route::get('/status-home/{id}', [
            'as' => 'products.statushome',
            'uses' => 'App\Http\Controllers\AdminProductController@changeStatusHome',
            'middleware' => (['CheckIsUser', 'can:gate-products-update'])
        ]);

        Route::get('/status-product/{id}', [
            'as' => 'products.statusproduct',
            'uses' => 'App\Http\Controllers\AdminProductController@changeStatusShow',
            'middleware' => (['CheckIsUser', 'can:gate-products-update'])
        ]);

        Route::get('/delete-thumbnail/{id}', [
            'as' => 'products.deletethumbnail',
            'uses' => 'App\Http\Controllers\AdminProductController@deleteThumbnail',
            'middleware' => (['CheckIsUser', 'can:gate-products-delete'])
        ]);
    });

    //gallery 
    Route::prefix('gallerys')->group(function () {
        Route::get('/', [
            'as' => 'gallerys.index',
            'uses' => 'App\Http\Controllers\AdminGalleryController@index',
            'middleware' => (['CheckIsUser', 'can:gate-albums-view'])
        ]);

        Route::get('/view/{id}', [
            'as' => 'gallerys.view',
            'uses' => 'App\Http\Controllers\AdminGalleryController@view',
            'middleware' => (['CheckIsUser', 'can:gate-albums-view'])
        ]);

        Route::get('/create', [
            'as' => 'gallerys.create',
            'uses' => 'App\Http\Controllers\AdminGalleryController@create',
            'middleware' => (['CheckIsUser', 'can:gate-albums-view'])
        ]);
        Route::post('/store', [
            'as' => 'gallerys.store',
            'uses' => 'App\Http\Controllers\AdminGalleryController@store',
            'middleware' => (['CheckIsUser', 'can:gate-albums-create'])
        ]);

        Route::get('/edit/{id}', [
            'as' => 'gallerys.edit',
            'uses' => 'App\Http\Controllers\AdminGalleryController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-albums-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'gallerys.update',
            'uses' => 'App\Http\Controllers\AdminGalleryController@update',
            'middleware' => (['CheckIsUser', 'can:gate-albums-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'gallerys.delete',
            'uses' => 'App\Http\Controllers\AdminGalleryController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-albums-delete'])
        ]);
        Route::get('/status-gallery/{id}', [
            'as' => 'gallerys.statusgallery',
            'uses' => 'App\Http\Controllers\AdminGalleryController@changeStatusShow',
            'middleware' => (['CheckIsUser', 'can:gate-albums-update'])
        ]);

        Route::get('/delete-thumbnail/{id}', [
            'as' => 'gallerys.deletethumbnail',
            'uses' => 'App\Http\Controllers\AdminGalleryController@deleteThumbnail',
            'middleware' => (['CheckIsUser', 'can:gate-albums-delete'])
        ]);
    });






    Route::prefix('profile')->group(function () {
        Route::get('/', [
            'as' => 'profile.index',
            'uses' => 'App\Http\Controllers\ProfileController@index',
            'middleware' => (['CheckIsUser'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'profile.update',
            'uses' => 'App\Http\Controllers\ProfileController@update',
            'middleware' => (['CheckIsUser'])
        ]);
    });



    Route::prefix('settings-pages')->group(function () {
        Route::get('/', [
            'as' => 'settings-pages.index',
            'uses' => 'App\Http\Controllers\AdminSettingPageController@index',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-view'])
        ]);
        Route::get('/create', [
            'as' => 'settings-pages.create',
            'uses' => 'App\Http\Controllers\AdminSettingPageController@create',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-view'])
        ]);
        Route::post('/store', [
            'as' => 'settings-pages.store' . '?type=' .  request()->type,
            'uses' => 'App\Http\Controllers\AdminSettingPageController@store',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-create'])
        ]);


        Route::get('/edit/{id}', [
            'as' => 'settings-pages.edit',
            'uses' => 'App\Http\Controllers\AdminSettingPageController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings-pages.update',
            'uses' => 'App\Http\Controllers\AdminSettingPageController@update',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings-pages.delete',
            'uses' => 'App\Http\Controllers\AdminSettingPageController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-delete'])
        ]);
        Route::post('/seleted-settings', [
            'as' => 'settings-pages.deleteselect',
            'uses' => 'App\Http\Controllers\AdminSettingPageController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-setting-page-delete'])
        ]);
    });



    //customer
    Route::prefix('customer')->group(function () {
        Route::get('/', [
            'as' => 'customer.index',
            'uses' => 'App\Http\Controllers\AdminCustommerController@index',
            'middleware' => (['CheckIsUser', 'can:gate-customer-view'])
        ]);
        Route::post('/store', [
            'as' => 'customer.store',
            'uses' => 'App\Http\Controllers\AdminCustommerController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'customer.edit',
            'uses' => 'App\Http\Controllers\AdminCustommerController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-customer-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'customer.update',
            'uses' => 'App\Http\Controllers\AdminCustommerController@update',
            'middleware' => (['CheckIsUser', 'can:gate-customer-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'customer.delete',
            'uses' => 'App\Http\Controllers\AdminCustommerController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-customer-delete'])
        ]);
        Route::post('/seleted-settings', [
            'as' => 'customer.deleteselect',
            'uses' => 'App\Http\Controllers\AdminCustommerController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-customer-delete'])
        ]);
        Route::get('/status-show/{id}', [
            'as' => 'customer.statushome',
            'uses' => 'App\Http\Controllers\AdminCustommerController@changeStatusShow',
            'middleware' => (['CheckIsUser', 'can:gate-customer-update'])
        ]);
    });



    //custommer role
    Route::prefix('customer-role')->group(function () {
        Route::get('/', [
            'as' => 'customer-role.index',
            'uses' => 'App\Http\Controllers\AdminCustomerRoleController@index',
            'middleware' => (['CheckIsUser'])
        ]);

        Route::get('/create', [
            'as' => 'customer-role.create',
            'uses' => 'App\Http\Controllers\AdminCustomerRoleController@create',
            'middleware' => (['CheckIsUser'])
        ]);

        Route::post('/store', [
            'as' => 'customer-role.store',
            'uses' => 'App\Http\Controllers\AdminCustomerRoleController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'customer-role.edit',
            'uses' => 'App\Http\Controllers\AdminCustomerRoleController@edit',
            'middleware' => (['CheckIsUser'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'customer-role.update',
            'uses' => 'App\Http\Controllers\AdminCustomerRoleController@update',
            'middleware' => (['CheckIsUser'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'customer-role.delete',
            'uses' => 'App\Http\Controllers\AdminCustomerRoleController@delete',
            'middleware' => (['CheckIsUser'])
        ]);
    });


    //custommer coupons
    Route::prefix('coupons')->group(function () {
        Route::get('/', [
            'as' => 'coupons.index',
            'uses' => 'App\Http\Controllers\CouponsController@index',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-view'])
        ]);

        Route::get('/create', [
            'as' => 'coupons.create',
            'uses' => 'App\Http\Controllers\CouponsController@create',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-view'])
        ]);

        Route::post('/store', [
            'as' => 'coupons.store',
            'uses' => 'App\Http\Controllers\CouponsController@store',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'coupons.edit',
            'uses' => 'App\Http\Controllers\CouponsController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'coupons.update',
            'uses' => 'App\Http\Controllers\CouponsController@update',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'coupons.delete',
            'uses' => 'App\Http\Controllers\CouponsController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-delete'])
        ]);
        Route::post('/seleted-settings', [
            'as' => 'coupons.deleteselect',
            'uses' => 'App\Http\Controllers\CouponsController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-coupons-delete'])
        ]);
    });


    //services
    Route::prefix('services')->group(function () {
        Route::get('/', [
            'as' => 'services.index',
            'uses' => 'App\Http\Controllers\AdminServicesController@index',
            'middleware' => (['CheckIsUser', 'can:gate-services-view'])
        ]);
        Route::get('/create', [
            'as' => 'services.create',
            'uses' => 'App\Http\Controllers\AdminServicesController@create',
            'middleware' => (['CheckIsUser', 'can:gate-services-view'])
        ]);
        Route::post('/store', [
            'as' => 'services.store',
            'uses' => 'App\Http\Controllers\AdminServicesController@store',
            'middleware' => (['CheckIsUser', 'can:gate-services-create'])
        ]);
        Route::get('/edit/{id}', [
            'as' => 'services.edit',
            'uses' => 'App\Http\Controllers\AdminServicesController@edit',
            'middleware' => (['CheckIsUser', 'can:gate-services-view'])
        ]);
        Route::post('/update/{id}', [
            'as' => 'services.update',
            'uses' => 'App\Http\Controllers\AdminServicesController@update',
            'middleware' => (['CheckIsUser', 'can:gate-services-update'])
        ]);
        Route::get('/delete/{id}', [
            'as' => 'services.delete',
            'uses' => 'App\Http\Controllers\AdminServicesController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-services-delete'])
        ]);

        Route::post('/seleted-post', [
            'as' => 'services.deleteselect',
            'uses' => 'App\Http\Controllers\AdminServicesController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-services-delete'])
        ]);


        Route::get('/status-home/{id}', [
            'as' => 'services.statushome',
            'uses' => 'App\Http\Controllers\AdminServicesController@changeStatusHome',
            'middleware' => (['CheckIsUser', 'can:gate-services-update'])
        ]);

        Route::get('/status-product/{id}', [
            'as' => 'services.statusproduct',
            'uses' => 'App\Http\Controllers\AdminServicesController@changeStatusShow',
            'middleware' => (['CheckIsUser', 'can:gate-services-update'])
        ]);
    });

    Route::prefix('message')->group(function () {
        Route::get('/', [
            'as' => 'message.index',
            'uses' => 'App\Http\Controllers\MessageController@index',
            'middleware' => (['CheckIsUser', 'can:gate-message-view'])
        ]);

        Route::get('/view/{email}', [
            'as' => 'message.view',
            'uses' => 'App\Http\Controllers\MessageController@view',
            'middleware' => (['CheckIsUser', 'can:gate-message-view'])
        ]);

        Route::get('/delete/{id}', [
            'as' => 'message.delete',
            'uses' => 'App\Http\Controllers\MessageController@delete',
            'middleware' => (['CheckIsUser', 'can:gate-message-delete'])
        ]);

        Route::post('/seleted-message', [
            'as' => 'message.deleteselect',
            'uses' => 'App\Http\Controllers\MessageController@deleteSelected',
            'middleware' => (['CheckIsUser', 'can:gate-message-delete'])
        ]);

        Route::post('/create', [
            'as' => 'message.create',
            'uses' => 'App\Http\Controllers\MessageController@create',
            'middleware' => (['CheckIsUser'])
        ]);

        Route::post('/send', [
            'as' => 'message.send',
            'uses' => 'App\Http\Controllers\MessageController@sendMail',
            'middleware' => (['CheckIsUser'])
        ]);
    });

    Route::prefix('order')->group(function () {
        Route::get('/', [
            'as' => 'order.index',
            'uses' => 'App\Http\Controllers\AdminOrderController@index',
            'middleware' => (['CheckIsUser'])
        ]);
    });
});





//frontend
Route::get('/', [
    'as' => 'home',
    'uses' => 'App\Http\Controllers\FrontEnd\HomeController@index'
]);

Route::get('/trang-chu', [
    'as' => 'home',
    'uses' => 'App\Http\Controllers\FrontEnd\HomeController@index'
]);

Route::get('/san-pham', [
    'as' => 'product.index',
    'uses' => 'App\Http\Controllers\FrontEnd\ProductsController@index'
]);

Route::get('/san-pham/{slug}', [
    'as' => 'product.detail',
    'uses' => 'App\Http\Controllers\FrontEnd\ProductsController@detail'
]);


Route::get('/dich-vu', [
    'as' => 'service.index',
    'uses' => 'App\Http\Controllers\FrontEnd\ServiceController@index'
]);

Route::get('/dich-vu/{slug}', [
    'as' => 'service.detail',
    'uses' => 'App\Http\Controllers\FrontEnd\ServiceController@detail'
]);

Route::get('/tin-tuc', [
    'as' => 'news.index',
    'uses' => 'App\Http\Controllers\FrontEnd\NewsController@index'
]);

Route::get('/tin-tuc/{slug}', [
    'as' => 'news.detail',
    'uses' => 'App\Http\Controllers\FrontEnd\NewsController@detail'
]);

Route::get('/lien-he', [
    'as' => 'contact.index',
    'uses' => 'App\Http\Controllers\FrontEnd\ContactController@index'
]);



Route::get('/log-out', [
    'as' => 'logout',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@logout'
]);

Route::get('/dang-nhap', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@login',
    'middleware' => (['alreadyLogin'])
]);

Route::post('/dang-nhap', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@loginPost',
    'middleware' => (['alreadyLogin'])
]);

Route::get('/dang-ky', [
    'as' => 'register',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@register',
    'middleware' => (['alreadyLogin'])
]);
Route::post('/dang-ky', [
    'as' => 'register',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@registerPost',
    'middleware' => (['alreadyLogin'])
]);


Route::get('/quen-mat-khau', [
    'as' => 'forgot',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@forgot',
    'middleware' => (['alreadyLogin'])
]);

Route::post('/quen-mat-khau', [
    'as' => 'forgot',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@forgotPost',
    'middleware' => (['alreadyLogin'])
]);

Route::get('/reset-password/{token}', [
    'as' => 'reset',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@reset',
]);

Route::post('/reset-password', [
    'as' => 'reset.token',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@resetPost',
]);


Route::post('/change-password/{id}', [
    'as' => 'change.password',
    'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@changePassword',
]);


Route::prefix('tai-khoan')->group(function () {
    Route::get('/{id}', [
        'as' => 'users.index',
        'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@profile',
        'middleware' => (['FrontEndCheckLoginCustomer'])
    ]);

    Route::post('/{id}/update', [
        'as' => 'users.update',
        'uses' => 'App\Http\Controllers\FrontEnd\CustomerController@update',
        'middleware' => (['FrontEndCheckLoginCustomer'])
    ]);
});


Route::get('/add-to-cart/{id}', [
    'as' => 'cart.add',
    'uses' => 'App\Http\Controllers\FrontEnd\ProductsController@addToCart',
]);



Route::prefix('gio-hang')->group(function () {
    Route::get('/', [
        'as' => 'cart.index',
        'uses' => 'App\Http\Controllers\FrontEnd\CartController@index',
    ]);

    Route::get('/cap-nhat', [
        'as' => 'cart.update',
        'uses' => 'App\Http\Controllers\FrontEnd\CartController@update',
    ]);
    Route::get('/xoa', [
        'as' => 'cart.delete',
        'uses' => 'App\Http\Controllers\FrontEnd\CartController@delete',
    ]);

    Route::get('/thanh-toan', [
        'as' => 'cart.checkout',
        'uses' => 'App\Http\Controllers\FrontEnd\CartController@checkout',
    ]);

    Route::post('/ma-giam-gia', [
        'as' => 'cart.coupons',
        'uses' => 'App\Http\Controllers\FrontEnd\CartController@coupons',
    ]);
});








Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'web'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
