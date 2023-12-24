<?php

namespace JennosGroup\Laratables\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/jg-laratables'),
        ], 'jg-laratables-assets');

        $this->publishes([
            __DIR__. '/../../resources/views' => resource_path('views/vendor/jg-laratables'),
        ], 'jg-laratables-views');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'jg-laratables');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
