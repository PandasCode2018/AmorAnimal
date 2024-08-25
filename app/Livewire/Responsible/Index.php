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
    public $perPage = 5;
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
    public function render()
    {
        return view('livewire.responsible.index');
    }
}
