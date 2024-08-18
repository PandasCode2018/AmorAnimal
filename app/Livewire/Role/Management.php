<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Http\Traits\WithMessages;
use App\Models\Role;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Management extends Component
{

    use WithMessages;
    use WithPagination;

    public $rolModal = false;
    public Role $role;
    public $rolePermissions = [];

    public function mount()
    {
        $this->role = new Role();
    }

    public function getPermissionsProperty()
    {
        return Permission::orderBy('name')->get();
    }

    public function rules()
    {
        return [
            //'role.name' => 'required|string|max:255|unique:roles,name,'.$this->role->id.',id,company_id,'.$this->role->company_id,
            'role.name' => 'required|string|max:255',
            'rolePermissions' => 'nullable|array|min:1|in:' . Permission::pluck('name')->implode(','), // solo permisos existentes
        ];
    }
    private function clearString()
    {
        // aplicar trim o null a los campos
        $fillable = $this->role->getFillable();
        foreach ($fillable as $field) {
            $this->role->$field = is_string($this->role->$field) ? mb_strtolower(trim($this->role->$field)) : $this->role->$field;
            if (empty($this->role->$field)) {
                unset($this->role->$field);
            }
        }
    }

    public function store()
    {

        $this->validate();
        $isEdit = (bool) $this->role->id;

        try {
            $this->clearString();
            $this->role->save();
            $this->role->syncPermissions($this->rolePermissions);
        } catch (\Throwable $th) {
            $this->showError('Error creando el rol');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Rol actualizado correctamente');
        } else {
            $this->showSuccess('Rol creado correctamente');
        }

        $this->closeModal();
        $this->dispatch('role-index:refresh');
        $this->role = new Role();
        $this->rolePermissions = [];
    }


    #[On('openRolModal')]
    public function openModal($roleId = '')
    {
        $this->role = new Role();
        $this->rolePermissions = [];
        $this->resetErrorBag();
        // $this->role->company_id = auth()->user()->company_id;
        if (!empty($roleId)) {
            $this->role = Role::find($roleId);
            $this->rolePermissions = $this->role->permissions->pluck('name')->toArray();
        }
        $this->rolModal = true;
    }
    public function closeModal()
    {
        $this->rolModal = false;
    }
    public function render()
    {
        return view('livewire.role.management');
    }
}
