<?php

namespace App\Classes;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Contracts\SEOTools as ContractsSEOTools;
class SearchEngineOptimization
{
    /**
     * Create a new class instance.
     */
    private SEOTools|ContractsSEOTools $SEOTools;

    public function __construct(string $title)
    {
        $this->SEOTools = SEOTools::setTitle($title);
    }
    public function setDescription(string $description):self
    {
        $this->SEOTools->setDescription($description);
        return $this;
    }
    public static function builder(string $title):self
    {
        return new self($title);
    }
}
