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

}
