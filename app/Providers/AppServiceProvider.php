<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(config('dashboard.prefix_view').'.*',function (\Illuminate\View\View $view){
            $view->with('linkSidebarAdmin',config('dashboard.route_sidebar'));
        });
    }
}
