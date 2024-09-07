<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    private const TIME_CACHE = 60 * 60;
    public static function get(string $key,callable $useCallable,?int $timeCache = null):mixed
    {
        return Cache::remember($key, $timeCache ?? self::TIME_CACHE, $useCallable(...));
    }
}
