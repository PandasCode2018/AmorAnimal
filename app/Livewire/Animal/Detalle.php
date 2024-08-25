<?php

namespace App\Livewire\Animal;

use App\Http\Traits\WithMessages;
use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\On;
use Ramsey\Uuid\Uuid;

class Detalle extends Component
{
    use WithMessages;

    public $detalleModalAnimal = false;
    public $animal;


    #[On('opeModalDetalleAnimal')]
    public function openModal($animalUuid)
    {
        if (!Uuid::isValid($animalUuid)) {
            $this->showError('Error con el id del del usuario a consultar');
            return;
        }
        $animal = Animal::uuid($animalUuid)->first();

        if (empty($animal)) {
            $this->showError('Error obteniendo los datos del  usuario consulado');
            return;
        }
        $this->animal = Animal::with(['animalSpecies', 'responsible'])->find($animal->id);

        if (empty($this->animal)) {
            $this->showError('Error obteniendo los datos del  usuario consulado');
            return;
        }
        $this->detalleModalAnimal = true;
    }

    public function closeModal()
    {
        $this->detalleModalAnimal = false;
    }
    public function render()
    {
        return view('livewire.animal.detalle');
    }
}
