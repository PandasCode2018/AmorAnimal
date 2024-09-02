<?php

namespace App\Livewire\User;


use App\Models\User;
use Ramsey\Uuid\Uuid;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Traits\WithMessages;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Management extends Component
{

    use WithFileUploads;
    use WithMessages;
    public $userModal = false;
    public User $user;
    public $userCompanyId;
    public $selectRoles;
    public $userRolesName = [];

    public function mount()
    {
        $this->user = new User();
        $this->userCompanyId = Auth::user()->company_id;
        $this->selectRoles = Role::where('company_id', $this->userCompanyId)->get();
    }

    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Correo',
        'document_number' => 'Docuemento',
        'password' => 'Contraseña',
        'phone' => 'Telefono',
        'address' => 'Dirección',
        'qualification' => 'Titulo',
        'specialty' => 'Especialización',
        'license_number' => 'Licencia',
        'years_experience' => 'Años de experiencia',
        'userRolesName' => 'Rol',
        'bool_doctor' => 'Doctor',
    ];

    private function clearString()
    {
        $fillable = $this->user->getFillable();
        foreach ($fillable as $field) {
            $this->user->$field = is_string($this->user->$field) ? mb_strtolower(trim($this->user->$field)) : $this->user->$field;
            if (empty($this->user->$field)) {
                unset($this->user->$field);
            }
        }
    }

    public function rules()
    {
        $validationEmail = $this->user?->id ? 'nullable|email|unique:users,email,' . $this->user?->id : 'nullable|email|unique:users,email';
        return [
            'user.name' => 'required|string|max:100|min:2',
            'user.email' => $validationEmail,
            'user.document_number' => [
                'nullable',
                'numeric',
                'digits_between:6,12',
                Rule::unique('users', 'document_number')->ignore($this->user?->id)
            ],
            'user.password' => 'nullable|string|min:8|max:12',
            'user.phone' => 'nullable|numeric|digits_between:6,12',
            'user.address' => 'nullable|string|max:100',
            'user.qualification' => 'nullable|string|max:100',
            'user.specialty' => 'nullable|string|max:100',
            'user.license_number' => 'nullable|string|max:100',
            'user.years_experience' => 'nullable|numeric|digits_between:1,2',
            'userRolesName' => 'required|string|min:1|exists:roles,name',
            'user.bool_doctor' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        abort_unless(Gate::any(['Crear users', 'Editar users']), 403);
        $this->validate();
        $isEdit = (bool) $this->user->id;

        try {
            $this->clearString();
            if (!$isEdit) {
                $this->user->password = bcrypt($this->user->document_number);
            } else {
                $this->user->password = bcrypt($this->user->password);
            }

            unset($this->user->rolesName);
            $this->user->bool_doctor = $this->user->bool_doctor ? 1 : 0;
            $this->user->company_id = $this->userCompanyId;
            $this->user->save();
            $this->user->syncRoles($this->userRolesName);
        } catch (\Throwable $th) {
            $this->showError('Error creando el registro, comuníquese con  soporte.');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Usuario actualizado correctamente');
        } else {
            $this->showSuccess('Usuario creado correctamente');
        }

        $this->closeModal();
        $this->dispatch('user-index:refresh');
        $this->user = new User();
    }


    #[On('openUserModal')]
    public function openModal($userUuid = '')
    {
        $this->user = new User();
        $this->userRolesName = [];
        $this->resetErrorBag();
        if (Uuid::isValid($userUuid)) {
            $this->user = User::uuid($userUuid)->first();
            $this->userRolesName = $this->user->roles->first()->name;
        }

        $this->userModal = true;
    }

    public function closeModal()
    {
        $this->userModal = false;
    }

    public function render()
    {
        return view('livewire.User.management');
    }
}
