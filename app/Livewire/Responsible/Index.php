<?php

namespace App\Livewire\Responsible;

use App\Http\Traits\withTours;
use Livewire\Component;
use App\Models\Responsible;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Http\Traits\WithMessages;
use App\Http\Traits\WithTableActions;


class Index extends Component
{

    use WithPagination;
    use WithTableActions;
    use WithMessages;
    use withTours;


    public $responsibles;
    public ?string $search = '';
    public $perPage = 6;
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

    public function getConfirmQuestionProperty(): string
    {
        $numbers = [rand(1, 10), rand(1, 10)];
        $operators = ['+', '-', '*'];
        $operator = $operators[array_rand($operators)];
        $result = eval("return $numbers[0] $operator $numbers[1];");

        return "¿Estás seguro de eliminar este registro? \n Escribe la respuesta $numbers[0] $operator $numbers[1]|$result";
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('tutorialResponsables')]
    public function tutorial()
    {
        $steps = config('MessageTour.responsables');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }
    public function render()
    {
        return view('livewire.responsible.index');
    }
}
