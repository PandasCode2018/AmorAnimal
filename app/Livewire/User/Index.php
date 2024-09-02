<?php

namespace App\Livewire\User;

use App\Http\Traits\withTours;
use App\Models\User;
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

    public  $user;

    public ?string $search = '';

    public $perPage = 6;

    protected $queryString = ['search'];

    protected $listeners = ['user-index:refresh' => 'refresh'];

    public function getUsersQueryProperty()
    {
        return User::filter($this->search);
    }

    public function getUsersProperty()
    {
        return $this->usersQuery->paginate($this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getConfirmQuestionProperty(): string
    {
        $numbers = [rand(1, 10), rand(1, 10)];
        $operators = ['+', '-', '*'];
        $operator = $operators[array_rand($operators)];
        $result = eval("return $numbers[0] $operator $numbers[1];");

        return "¿Estás seguro de eliminar este registro? \n Escribe la respuesta $numbers[0] $operator $numbers[1]|$result";
    }

    #[On('tutorialUsuarios')]
    public function tutorial()
    {
        $steps = config('MessageTour.usuarios');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }

    public function render()
    {
        return view('livewire.User.index');
    }
}
