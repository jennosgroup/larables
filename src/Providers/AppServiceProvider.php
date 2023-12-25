<?php

namespace JennosGroup\Larables\Providers;

use Illuminate\Support\ServiceProvider;
use JennosGroup\Larables\Larables;

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
            __DIR__ . '/../../public' => public_path(Larables::assetsRelativePath()),
        ], Larables::assetsTagId());

        $this->publishes([
            __DIR__. '/../../resources/views' => resource_path(Larables::viewsRelativePath()),
        ], Larables::viewsTagId());

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', Larables::viewsId());
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
