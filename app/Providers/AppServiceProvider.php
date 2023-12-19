<?php

namespace App\Providers;

use App\Models\Banquet;
use App\Models\Beverage;
use App\Models\Food;
use App\Models\Setting;
use App\Service\PaymentService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentService::class, function ($app) {
            return new PaymentService();
        });

        /**
         * Modify the current URL with new query parameters.
         *
         * @param  array  $newParams
         * @return string
         */
        app('view')->composer('*', function ($view) {
            $view->with('modify_query_parameter', function ($newParams) {
                $currentRoute = Route::current();
                $queryParams = array_merge(request()->query(), $newParams);
                return url($currentRoute->uri(), $currentRoute->parameters()) . '?' . http_build_query($queryParams);
            });
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.layout', function ($view) {
            $foods = Food::all();
            $beverages = Beverage::all();
            $setting = Setting::find(1);
            $banquets = Banquet::all();

            $view->with('foods', $foods);
            $view->with('beverages', $beverages);
            $view->with('setting', $setting);
            $view->with('banquets', $banquets);
        });

        view()->composer('admin.layouts.layout', function ($view) {
            $setting = Setting::find(1);
            $view->with('setting', $setting);
        });
    }
}
