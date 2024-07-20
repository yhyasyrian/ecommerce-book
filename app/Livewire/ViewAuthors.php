<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class ViewAuthors extends ViewUtilities
{
    protected static string $TABLE = 'author_book';

    protected function getModel(): Model
    {
        return new Author;
    }

    protected function getArrayWhere(): array
    {
        return ['name', 'description'];
    }

    protected function getArraySelect(): array
    {
        return ['name', 'id as slug'];
    }

    public function getRouteUtilityProperty(): string
    {
        return 'authors.show';
    }

    public function getTitleUtilityProperty(): string
    {
        return 'المؤلفون';
    }
}
