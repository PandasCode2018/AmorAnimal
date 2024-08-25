<?php

namespace App\Livewire\Animal;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithTableActions;
use App\Http\Traits\WithMessages;
use App\Models\AnimalSpecies;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;
    use WithMessages;

    public $Animals;
    public $animalEspecies;
    public ?string $search = '';
    public $perPage = 6;
    protected $queryString = ['search'];
    protected $listeners = ['animal-index:refresh' => 'refresh'];

    public function mount()
    {

        $this->animalEspecies = AnimalSpecies::where('company_id', 98)->get();
    }

    /*  public function getanimalEspeciesQueryProperty()
    {

        AnimalSpecies::filter();
    }

    public function getanimalEspeciesProperty()
    {

        return $this->animalEspecies->paginate($this->perPage);
    } */


    public function getAnimalsQueryProperty()
    {

        return Animal::filter($this->search);
    }

    public function getAnimalsProperty()
    {

        return $this->AnimalsQuery->paginate($this->perPage);
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

        return view('livewire.animal.index');
    }
}
