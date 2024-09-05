<?php

namespace App\Livewire\Consultation;

use App\Http\Traits\withTours;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Consultation;
use Livewire\WithPagination;
use App\Http\Traits\WithMessages;
use App\Http\Traits\WithTableActions;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;
    use WithMessages;
    use withTours;

    public Consultation $consultations;
    public ?string $search = '';
    public $perPage = 6;
    protected $queryString = ['search'];
    protected $listeners = ['consultation-index:refresh' => 'refresh'];
    public $tipoConsultas = [0 => 'Vacunación', 1 => 'Desparacitación', 2 => 'Estético', 3  => 'Tratamiento', 4 => 'Otro'];

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

    #[On('tutorialConsultas')]
    public function tutorial()
    {
        $steps = config('MessageTour.consultas');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }
    public function render()
    {
        return view('livewire.consultation.index');
    }
}
