<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Notification extends Component
{
    public string $title = '';
    public string $description = '';
    public $listeners = ['setData'];
    public function render(): View|Factory|Application
    {
        return view('livewire.notification');
    }
    public function hiddenValue():void
    {
        $this->title = $this->description = '';
    }
    public function setData(string $title, string $description): void{
        $this->title = $title;
        $this->description = $description;
    }
}
