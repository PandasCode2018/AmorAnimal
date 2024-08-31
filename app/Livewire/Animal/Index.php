<?php

namespace App\Livewire\Animal;

use App\Http\Traits\withTours;
use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\AnimalSpecies;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\WithTableActions;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;
    use WithMessages;
    use withTours;

    public $Animals;
    public $AnimalEspecies;
    public ?string $search = '';
    public $perPage = 6;
    protected $queryString = ['search'];
    protected $listeners = ['animal-index:refresh' => 'refresh'];     

    public function getAnimalEspeciesQueryProperty()
    {
        return AnimalSpecies::filter();
    }
    public function getAnimalEspeciesProperty()
    {

        return $this->animalEspeciesQuery->get();
    }

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

    #[On('tutorialAnimales')]
    public function tutorial()
    {
        $steps = config('MessageTour.animales');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }

    public function render()
    {

        return view('livewire.animal.index');
    }
}
