<?php

namespace App\Livewire\Responsible;

use App\Models\Responsible;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithTableActions;
use App\Http\Traits\WithMessages;

class Index extends Component
{

    use WithPagination;
    use WithTableActions;
    use WithMessages;


    public $responsibles;
    public ?string $search = '';
    public $perPage = 8;
    protected $queryString = ['search'];

    protected $listeners = ['responsible-index:refresh' => 'refresh'];


    public function getResponsibleQueryProperty()
    {

        return Responsible::filter($this->search);
    }

    public function getResponsiblesProperty()
    {

        return $this->responsibleQuery->paginate($this->perPage);
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.responsible.index');
    }
}
