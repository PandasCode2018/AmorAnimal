<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\WithMessages;

class Management extends Component
{

    use WithFileUploads, WithMessages;
    public $userModal = false;
    public User $user;
    public $userCompanyId;

    public function mount()
    {
        $this->user = new User();
        $this->userCompanyId = Auth::user()->company_id;
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
        $validationPassword = $this->user?->id ? 'nullable|string|min:8|max:12' : 'required|string|min:8|max:12';

        return [
            'user.name' => 'required|string|max:100|min:2',
            'user.email' => $validationEmail,
            'user.document_number' => 'nullable|numeric|digits_between:5,15|unique:users,document_number',
            'user.password' => $validationPassword,
            'user.phone' => 'nullable|numeric|digits_between:6,12',
            'user.address' => 'nullable|string|max:100',
            'user.qualification' => 'nullable|string|max:100',
            'user.specialty' => 'nullable|string|max:100',
            'user.license_number' => 'nullable|string|max:100',
            'user.years_experience' => 'nullable|numeric|digits_between:1,2',
            //'userRolesName' => 'required|array|min:1|in:' . $this->roles->pluck('name')->implode(','),
        ];
    }

    public function store()
    {

        $this->validate();
        $isEdit = (bool) $this->user->id;

        try {
            $this->clearString();
            if ($this->user->password) {
                $this->user->password = bcrypt($this->user->password);
            }
            //unset($this->user->rolesName);
            $this->user->company_id = $this->userCompanyId;
            $this->user->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el usuario');
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
        if (Uuid::isValid($userUuid)) {
            $this->user = User::uuid($userUuid)->first();
        }

        $this->userModal = true;
    }

    public function closeModal()
    {
        $this->userModal = false;
    }

    public function render()
    {
        return view('livewire.user.management');
    }
}
