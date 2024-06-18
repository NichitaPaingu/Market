<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('components.block-header.header-top', 'header-top');
        Blade::component('components.block-header.header-main', 'header-main');
        Blade::component('components.block-header.header-catalog', 'header-catalog');
        
        Blade::component('components.block-header.top.city', 'city');
        Blade::component('components.block-header.top.top-links', 'top-links');

        Blade::component('components.block-header.main.logo', 'logo');
        Blade::component('components.block-header.main.form-search', 'form-search');
        Blade::component('components.block-header.main.service-links', 'service-links');

        Blade::component('components.block-header.catalog.burger-categories', 'burger-categories');
        Blade::component('components.block-header.catalog.burger-content', 'burger-content');
        Blade::component('components.block-header.catalog.burger-button', 'burger-button');
        Blade::component('components.block-header.catalog.catalog-links', 'catalog-links');


        Blade::component('components.block-main.popular-brands', 'popular-brands');
        Blade::component('components.block-main.recomended-products', 'recomended-products');
        Blade::component('components.block-main.popular-products', 'popular-products');
        Blade::component('components.block-main.categories-carousel', 'categories-carousel');
        Blade::component('components.block-main.deals', 'deals');
        Blade::component('components.block-main.youHaveSeen', 'youHaveSeen');
        Blade::component('components.block-main.info-page', 'info-page');
        Blade::component('components.block-main.reviews', 'reviews');
        Blade::component('components.block-main.rating', 'rating');


        Blade::component('user.user-dashboard', 'user-dashboard');
        Blade::component('admin.admin-dashboard', 'admin-dashboard');


        Blade::component('components.succes', 'succes');




        Blade::component('components.block-footer.footer-content', 'footer-content');


    }
}
