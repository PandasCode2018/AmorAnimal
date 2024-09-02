<?php

namespace App\Livewire\Audit;

use Livewire\Component;
use Livewire\Attributes\On;
use OwenIt\Auditing\Models\Audit;

class Management extends Component
{
    public Audit $audit;

    public $modalAudit = false;

    public function mount()
    {
        $this->audit = new Audit();
    }

    #[On('openModalAudit')]
    public function openModal(Audit $audit)
    {
        $this->audit = $audit;
        $this->modalAudit = true;
    }

    public function closetModal()
    {
        $this->modalAudit = false;
    }


    public function render()
    {
        return view('livewire.Audit.management');
    }
}
