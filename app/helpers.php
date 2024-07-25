<?php

if (! function_exists('routeDashboard')) {
    function routeDashboard(string $name,$parameters = [],$absolute = true):string
    {
        return route(config('dashboard.prefix_route').'.'.$name,$parameters,$absolute);
    }
}
