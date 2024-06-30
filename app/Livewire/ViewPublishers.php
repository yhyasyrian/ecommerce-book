<?php

namespace App\Livewire;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Model;

class ViewPublishers extends ViewUtilities
{

    protected function getModel(): Model
    {
        return new Publisher;
    }

    protected function getArrayWhere(): array
    {
        return ['name','address'];
    }

    protected function getArraySelect(): array
    {
        return ['name','id as slug'];
    }

    public function getRouteUtilityProperty(): string
    {
        return 'publishers.show';
    }

    public function getTitleUtilityProperty(): string
    {
        return 'الناشرين';
    }
}
