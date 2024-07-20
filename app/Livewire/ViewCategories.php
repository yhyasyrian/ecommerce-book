<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class ViewCategories extends ViewUtilities
{
    protected function getModel(): Model
    {
        return new Category;
    }

    protected function getArrayWhere(): array
    {
        return ['name', 'slug'];
    }

    protected function getArraySelect(): array
    {
        return ['name', 'slug'];
    }

    public function getRouteUtilityProperty(): string
    {
        return 'categories.show';
    }

    public function getTitleUtilityProperty(): string
    {
        return 'التصنيفات';
    }
}
