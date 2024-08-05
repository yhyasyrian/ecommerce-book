<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $type = 'text',
        public array|\Illuminate\Support\Collection $options = [],
        public array $optionSelected = [],
        public string $label = '',
        public mixed $oldData = '',
        public array $otherAttributes = [],
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.input');
    }
}
