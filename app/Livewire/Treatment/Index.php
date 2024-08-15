<?php

namespace App\Livewire\Treatment;

use App\Models\Consultation;
use App\Models\Treatment;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public $indexModal = false;
    public $idConsulta;
    public ?string $search = '';

    public $perPage = 8;

    protected $queryString = ['search'];

    protected $listeners = ['teatment-index:refresh' => 'refresh', 'openTreatmentModal' => 'loadTreatmentData'];


    public function getTreatmentQueryProperty()
    {

        return Treatment::filter($this->search, $this->idConsulta);
    }

    public function getTreatmentProperty()
    {

        return $this->TreatmentQuery->get();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('indexTratamientoModal')]
    public function openModal($idConsulta)
    {

        $this->indexModal = true;
        $this->idConsulta = $idConsulta;
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
