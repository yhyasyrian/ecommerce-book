<?php

namespace App\Providers;

use App\Enums\RolesEnum;
use App\Models\Category;
use App\Models\User;
use App\Services\CacheService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Debugbar', Debugbar::class);
        Gate::define('update-user', function (User $user) {
            return $user->role()->checkIfCanEqual(RolesEnum::OWNER->value);
        });
        Gate::define('update-book', function (User $user) {
            return $user->role()->checkIfCan(RolesEnum::ADMIN->value);
        });
        Gate::define('access-dashboard', function (User $user) {
            return $user->role()->checkIfCanEqual(RolesEnum::ADMIN->value);
        });
        View::composer('components.footer', function (\Illuminate\View\View $view) {
            $view->with('footerCategories', CacheService::get('categories', fn() => Category::query()->get(['name', 'slug'])));
        });
        View::composer(config('dashboard.prefix_view') . '.*', function (\Illuminate\View\View $view) {
            $view->with('linkSidebarAdmin', config('dashboard.route_sidebar'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(User::class);
    }
}
