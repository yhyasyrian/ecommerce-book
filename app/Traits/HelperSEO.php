<?php

namespace App\Traits;

use App\Classes\SearchEngineOptimization;

trait HelperSEO
{
    protected function SEO(string $title):searchEngineOptimization
    {
        return new SearchEngineOptimization($title);
    }
}
