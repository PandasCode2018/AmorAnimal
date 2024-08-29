<?php

namespace App\Livewire\Role;

use App\Http\Traits\withTours;
use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Http\Traits\WithMessages;
use App\Http\Traits\WithTableActions;

class Index extends Component
{
    use WithMessages;
    use WithPagination;
    use WithTableActions;
    use withTours;

    public ?string $search = '';
    public $perPage = 6;
    protected $queryString = ['search'];
    protected $listeners = ['role-index:refresh' => 'refresh'];


    public function mount() {}

    public function getRolesQueryProperty()
    {
        return Role::filter($this->search);
    }

    public function getRolesProperty()
    {
        return $this->rolesQuery->paginate($this->perPage);
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

    #[On('tutorialRoles')]
    public function tutorial()
    {
        $steps = config('MessageTour.roles');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }
    public function render()
    {
        return view('livewire.role.index');
    }
}
