<?php

namespace App\Livewire\Audit;

use App\Models\Audit;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?string $search = '';

    public $perPage = 8;

    protected $queryString = ['search'];

    protected $listeners = ['Audit-index:refresh' => 'refresh'];

    public function getAuditsQueryProperty()
    {
        return Audit::filter($this->search);
    }

    public function getAuditsProperty()
    {
        return $this->auditsQuery->paginate($this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.audit.index');
    }
}
