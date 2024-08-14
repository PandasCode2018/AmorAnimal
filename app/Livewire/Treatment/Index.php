<?php

namespace App\Livewire\Treatment;

use App\Models\Consultation;
use App\Models\Treatment;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $indexModal = false;
    public Treatment $consulta;
    public $tratamiento;
    public ?string $search = '';

    public $perPage = 8;

    protected $queryString = ['search'];

    protected $listeners = ['consultation-index:refresh' => 'refresh'];


    public function getCosaQueryProperty()
    {

        return Treatment::filter($this->search);
    }

    public function getCosaProperty()
    {

        return $this->cosaQuery->paginate($this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('indexTratamientoModal')]
    public function openModal()
    {

        $this->indexModal = true;
    }

    public function closeModal()
    {
        $this->indexModal = false;
    }

    public function render()
    {
        return view('livewire.treatment.index');
    }
}
