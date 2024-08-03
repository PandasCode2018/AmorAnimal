<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class Management extends Component
{

    use WithFileUploads;
    public User $user;
    public function render()
    {
        return view('livewire.user.management');
    }



    #[On('openUserModal')]
    public function openModal($userUuid = '')
    {
        $this->resetErrorBag();

        $this->user = new User();

        if (Uuid::isValid($userUuid)) {
            $this->user = User::uuid($userUuid)->first();
        }

        $this->user->company_id = Auth::user()->company_id;

        $this->dispatch(
            'openModal',
            modalId: 'manage-user-modal',
        );
    }
}
