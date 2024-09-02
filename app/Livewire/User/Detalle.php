<?php

namespace App\Livewire\User;

use App\Http\Traits\WithMessages;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Livewire\Component;
use Livewire\Attributes\On;

class Detalle extends Component
{

    use WithMessages;

    public $detalleUsertoModal = false;
    public $user;


    #[On('detalleUsertoModal')]
    public function openModal($userUuid)
    {

        if (Uuid::isValid($userUuid)) {
            $this->user = User::uuid($userUuid)->first();

            if (empty($this->user)) {
                $this->showError('Error en obtener la información');
                return;
            }
            $this->detalleUsertoModal = true;
        }
    }

    public function closeModal()
    {
        $this->detalleUsertoModal = false;
    }
    public function render()
    {
        return view('livewire.User.detalle');
    }
}
