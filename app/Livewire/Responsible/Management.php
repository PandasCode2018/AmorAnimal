<?php

namespace App\Livewire\Responsible;

use Livewire\Component;
use Livewire\Attributes\On;

class Management extends Component
{



    #[On('openCompanyModal')]
    public function openModal($companyUuid = '')
    {

        $this->dispatch(
            'openModal',
            modalId: 'manage-company-modal',
        );
    }
    public function render()
    {
        return view('livewire.responsible.management');
    }
}
