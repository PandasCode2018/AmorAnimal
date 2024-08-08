<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Http\Traits\WithMessages;
use App\Models\User;
use Livewire\WithPagination;
use App\Http\Traits\WithTableActions;

class Index extends Component
{

    use WithPagination, WithTableActions, WithMessages;

    public  $user;

    public ?string $search = '';

    public $perPage = 8;

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

    public function render()
    {
        return view('livewire.user.index');
    }
}
