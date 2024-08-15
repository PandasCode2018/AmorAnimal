<?php

namespace App\Livewire\Consultation;

use App\Models\Query_status;
use Livewire\Component;
use Livewire\Attributes\On;

class Estado extends Component
{

    public $estadosModal = false;
    public function render()
    {
        $estados = Query_status::all();
        return view('livewire.consultation.estado', ['estados' => $estados]);
    }


    #[On('openEstatusModal')]
    public function updateStatus($statusIdActual, $statusUuid)
    {

        $this->estadosModal = true;
        return;
    }

    public function closeModal()
    {
        $this->estadosModal = false;
    }
}
