<?php

namespace App\Livewire\Animal;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.animal.index');
    }


    public $showModalAnimal = false;
    public $user;

    protected $listeners = ['openModal' => 'loadUser'];

    public function closeModal()
    {
        $this->showModalAnimal = false;
    }
}
