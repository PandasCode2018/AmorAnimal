<?php

namespace App\Livewire\Consultation;

use App\Http\Traits\WithMessages;
use App\Http\Traits\WithTableActions;
use App\Models\Consultation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;
    use WithMessages;

    public Consultation $consultations;
    public ?string $search = '';
    public $perPage = 6;
    protected $queryString = ['search'];
    protected $listeners = ['consultation-index:refresh' => 'refresh'];

    public function getConsultationsQueryProperty()
    {

        return Consultation::filter($this->search);
    }

    public function getConsultationsProperty()
    {

        return $this->ConsultationsQuery->paginate($this->perPage);
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
    public function render()
    {
        return view('livewire.consultation.index');
    }
}
