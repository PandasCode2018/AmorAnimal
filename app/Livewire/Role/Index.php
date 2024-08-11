<?php

namespace App\Livewire\Role;

use App\Http\Traits\WithMessages;
use App\Http\Traits\WithTableActions;
use Livewire\Component;
use App\Models\Role;
use Livewire\WithPagination;

class Index extends Component
{
    use WithMessages;
    use WithPagination;
    use  WithTableActions;

    public ?string $search = '';
    public $perPage = 8;
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
    public function render()
    {
        return view('livewire.role.index');
    }
}
