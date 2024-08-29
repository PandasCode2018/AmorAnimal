<?php

namespace App\Livewire\Treatment;

use App\Http\Traits\WithMessages;
use Ramsey\Uuid\Uuid;
use Livewire\Component;
use App\Models\Treatment;
use Livewire\Attributes\On;

class Detalle extends Component
{

    use WithMessages;
    public $detalleModalTratamiento = false;
    public $treatment;
    public function render()
    {
        return view('livewire.treatment.detalle');
    }

    #[On('detalleTratamientoModal')]
    public function openModal($tratamientoUuid)
    {
        if (empty($tratamientoUuid)) {
            
            $this->showWarning('No se pude recibir el nombre del tratamiento');
            return;
        }
        
        $this->treatment = new Treatment();
        $this->resetErrorBag();
        if (Uuid::isValid($tratamientoUuid)) {
            $this->treatment = Treatment::uuid($tratamientoUuid)->first();
        }
        $this->detalleModalTratamiento = true;
    }

    public function closeModal()
    {
        $this->detalleModalTratamiento = false;
    }
}
