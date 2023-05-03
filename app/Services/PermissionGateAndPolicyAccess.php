<?php
namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicyAccess () {
        $this->defineGateCategory();
    }
    public function defineGateCategory () {
        //category
        Gate::define('gate-category-view', 'App\Policies\ProductCategoryPolicy@view');
        Gate::define('gate-category-create', 'App\Policies\ProductCategoryPolicy@create');
        Gate::define('gate-category-update', 'App\Policies\ProductCategoryPolicy@update');
        Gate::define('gate-category-delete', 'App\Policies\ProductCategoryPolicy@delete');

        //list user
        Gate::define('gate-settings-view', 'App\Policies\SettingsUserPolicy@view');
        Gate::define('gate-settings-create', 'App\Policies\SettingsUserPolicy@create');
        Gate::define('gate-settings-update', 'App\Policies\SettingsUserPolicy@update');
        Gate::define('gate-settings-delete', 'App\Policies\SettingsUserPolicy@delete');

        //list role
        Gate::define('gate-role-view', 'App\Policies\RoleUserPolicy@view');
        Gate::define('gate-role-create', 'App\Policies\RoleUserPolicy@create');
        Gate::define('gate-role-update', 'App\Policies\RoleUserPolicy@update');
        Gate::define('gate-role-delete', 'App\Policies\RoleUserPolicy@delete');

        //permissions
        Gate::define('gate-permissions-view', 'App\Policies\PermissionsUserPolicy@view');
        Gate::define('gate-permissions-create', 'App\Policies\PermissionsUserPolicy@create');

        //list menu
        Gate::define('gate-menu-view', 'App\Policies\MenuPolicy@view');
        Gate::define('gate-menu-create', 'App\Policies\MenuPolicy@create');
        Gate::define('gate-menu-update', 'App\Policies\MenuPolicy@update');
        Gate::define('gate-menu-delete', 'App\Policies\MenuPolicy@delete');

        //post 
        Gate::define('gate-post-view', 'App\Policies\PostPolicy@view');
        Gate::define('gate-post-create', 'App\Policies\PostPolicy@create');
        Gate::define('gate-post-update', 'App\Policies\PostPolicy@update');
        Gate::define('gate-post-delete', 'App\Policies\PostPolicy@delete');

        //products 
        Gate::define('gate-products-view', 'App\Policies\PorductsPolicy@view');
        Gate::define('gate-products-create', 'App\Policies\PorductsPolicy@create');
        Gate::define('gate-products-update', 'App\Policies\PorductsPolicy@update');
        Gate::define('gate-products-delete', 'App\Policies\PorductsPolicy@delete');

        //customer
        Gate::define('gate-customer-view', 'App\Policies\CustomerPolicy@view');
        Gate::define('gate-customer-create', 'App\Policies\CustomerPolicy@create');
        Gate::define('gate-customer-update', 'App\Policies\CustomerPolicy@update');
        Gate::define('gate-customer-delete', 'App\Policies\CustomerPolicy@delete');

        //post category
        Gate::define('gate-post-category-view', 'App\Policies\PostCategoryPolicy@view');
        Gate::define('gate-post-category-create', 'App\Policies\PostCategoryPolicy@create');
        Gate::define('gate-post-category-update', 'App\Policies\PostCategoryPolicy@update');
        Gate::define('gate-post-category-delete', 'App\Policies\PostCategoryPolicy@delete');

        //post tags
        Gate::define('gate-post-tags-view', 'App\Policies\PostTagsPolicy@view');
        Gate::define('gate-post-tags-create', 'App\Policies\PostTagsPolicy@create');
        Gate::define('gate-post-tags-update', 'App\Policies\PostTagsPolicy@update');
        Gate::define('gate-post-tags-delete', 'App\Policies\PostTagsPolicy@delete');

        //products tags
        Gate::define('gate-products-tags-view', 'App\Policies\ProductsTagsPolicy@view');
        Gate::define('gate-products-tags-create', 'App\Policies\ProductsTagsPolicy@create');
        Gate::define('gate-products-tags-update', 'App\Policies\ProductsTagsPolicy@update');
        Gate::define('gate-products-tags-delete', 'App\Policies\ProductsTagsPolicy@delete');

        //services
        Gate::define('gate-services-view', 'App\Policies\ServicesPolicy@view');
        Gate::define('gate-services-create', 'App\Policies\ServicesPolicy@create');
        Gate::define('gate-services-update', 'App\Policies\ServicesPolicy@update');
        Gate::define('gate-services-delete', 'App\Policies\ServicesPolicy@delete');


        //slider
        Gate::define('gate-slider-view', 'App\Policies\SliderPolicy@view');
        Gate::define('gate-slider-create', 'App\Policies\SliderPolicy@create');
        Gate::define('gate-slider-update', 'App\Policies\SliderPolicy@update');
        Gate::define('gate-slider-delete', 'App\Policies\SliderPolicy@delete');

        //album
        Gate::define('gate-albums-view', 'App\Policies\AlbumsPolicy@view');
        Gate::define('gate-albums-create', 'App\Policies\AlbumsPolicy@create');
        Gate::define('gate-albums-update', 'App\Policies\AlbumsPolicy@update');
        Gate::define('gate-albums-delete', 'App\Policies\AlbumsPolicy@delete');


        //coupons
        Gate::define('gate-coupons-view', 'App\Policies\CouponsPolicy@view');
        Gate::define('gate-coupons-create', 'App\Policies\CouponsPolicy@create');
        Gate::define('gate-coupons-update', 'App\Policies\CouponsPolicy@update');
        Gate::define('gate-coupons-delete', 'App\Policies\CouponsPolicy@delete');

        //message
        Gate::define('gate-message-view', 'App\Policies\MessagePolicy@view');
        Gate::define('gate-message-create', 'App\Policies\MessagePolicy@create');
        Gate::define('gate-message-update', 'App\Policies\MessagePolicy@update');
        Gate::define('gate-message-delete', 'App\Policies\MessagePolicy@delete');

        //setting page
        Gate::define('gate-setting-page-view', 'App\Policies\SettingPagePolicy@view');
        Gate::define('gate-setting-page-create', 'App\Policies\SettingPagePolicy@create');
        Gate::define('gate-setting-page-update', 'App\Policies\SettingPagePolicy@update');
        Gate::define('gate-setting-page-delete', 'App\Policies\SettingPagePolicy@delete');
    }
}