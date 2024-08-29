<?php

namespace App\Livewire\Treatment;

use Livewire\Component;
use App\Models\Treatment;
use Livewire\Attributes\On;
use App\Models\Consultation;
use Livewire\WithPagination;
use App\Http\Traits\WithTableActions;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;

    public $indexModal = false;
    public ?string $search = '';
    public $perPage = 6;
    public $valor;
    protected $queryString = ['search'];
    protected $listeners = ['treatment-index:refresh' => 'refresh'];
    public $datos;
    public $consultaId;

    public function getTreatmentQuery($idConsulta)
    {
        return Treatment::where('company_id', auth()->user()->company_id)
            ->where('consultation_id', $idConsulta)
            ->with(['company', 'consultation', 'user'])
            ->orderByDesc('id');
    }

    public function treatment($idConsulta)
    {
        return $this->getTreatmentQuery($idConsulta)->get();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getConfirmQuestionProperty(): string
    {
        $numbers = [rand(1, 10), rand(1, 10)];
        $operators = ['+', '-', '*'];
        $operator = $operators[array_rand($operators)];
        $result = eval("return $numbers[0] $operator $numbers[1];");

        return "¿Estás seguro de eliminar este registro? \n Escribe la respuesta $numbers[0] $operator $numbers[1]|$result";
    }

    #[On('indexTratamientoModal')]
    public function openModal($idConsulta)
    {
        $this->consultaId = $idConsulta;
        $this->datos = $this->treatment($idConsulta);
        $this->indexModal = true;
        $this->dispatch('consultaIdSet', $this->consultaId);
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
