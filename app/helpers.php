<?php

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

if (!function_exists('routeDashboard')) {
    /**
     * Generate the URL in dashboard to a named route.
     * @param string $name : name route
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function routeDashboard(string $name, array $parameters = [], bool $absolute = true): string
    {
        return route(config('dashboard.prefix_route') . '.' . $name, $parameters, $absolute);
    }
}
if (!function_exists('isRouteDashboard')) {
    /**
     * return true if user exists route
     * @param string $name : name route
     * @return bool
     */
    function isRouteDashboard(string $name): bool
    {
        return request()->routeIs(config('dashboard.prefix_view') . '.' .$name);
    }
}
if (!function_exists('viewDashboard')) {
    /**
     * view dashboard
     * @param string $name
     * @param array $data
     * @param array $mergeData
     * @return Factory|Application|View
     */
    function viewDashboard(string $name, array $data = [], array $mergeData = []): Factory|Application|View
    {
        return view(config('dashboard.prefix_view') . '.' . $name, $data, $mergeData);
    }
}
