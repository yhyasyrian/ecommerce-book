<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public \stdClass|Collection|\Illuminate\Pagination\LengthAwarePaginator $rows,
        public array $columns,
        public string $nameRoute,
        public string $paramRoute
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.table');
    }
}
