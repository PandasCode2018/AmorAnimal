<?php

namespace App\Livewire\Historial;

use App\Http\Traits\withTours;
use App\Models\Animal;
use Livewire\Component;
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


    public $animalId;
    public $Animals;
    public ?string $search = '';
    public $perPage = 8;
    protected $queryString = ['search'];
    protected $listeners = ['historial-index:refresh' => 'refresh'];


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

    #[On('tutorialHistorial')]
    public function tutorial()
    {
        $steps = config('MessageTour.historial');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }
    public function render()
    {
        return view('livewire.historial.index');
    }
}
