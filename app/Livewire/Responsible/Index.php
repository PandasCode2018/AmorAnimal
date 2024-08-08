<?php

namespace App\Livewire\Responsible;

use Livewire\Component;

class Index extends Component
{
    public ?string $search = '';

    protected $queryString = ['search'];

    protected $listeners = ['company-index:refresh' => 'refresh'];
    public function render()
    {
        return view('livewire.responsible.index');
    }
}
