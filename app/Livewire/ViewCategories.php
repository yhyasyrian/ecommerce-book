<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ViewCategories extends ViewUtilities
{
    protected function getModel(): Model
    {
        return new Category;
    }
    protected function getArrayWhere(): array
    {
        return ['name','slug'];
    }
    protected function getArraySelect(): array
    {
        return ['name','slug'];
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
