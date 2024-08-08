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

    private $userCompanyId;

    public function mount()
    {
        $this->user = new User();
        $this->userCompanyId = Auth::user()->company_id;
    }

    public function rules()
    {
        $validationEmail = $this->user?->id ? 'nullable|email|unique:users,email,' . $this->user?->id : 'nullable|email|unique:users,email';
        $validationPassword = $this->user?->id ? 'nullable|string|min:8|max:12' : 'required|string|min:8|max:12';

        return [
            'user.name' => 'required|string|:max:100|min:2',
            'user.document_number' => 'numeric',
            'user.phone' => 'nullable|numeric|digits_between:6,12',
            'user.email' => $validationEmail,
            'user.address' => 'nullable|string',
            'user.qualification' => 'nullable|string',
            'user.specialty' => 'nullable|string',
            'user.license_number' => 'nullable|string',
            'user.password' => $validationPassword,
            'user.company_id' => 'exists:companies,id',
            //'userRolesName' => 'required|array|min:1|in:'.$this->roles->pluck('name')->implode(','),
        ];
    }

    public function store()
    {

        $this->validate();

        $isEdit = (bool) $this->user->id;

        try {
            if ($this->user->password) {
                $this->user->password = bcrypt($this->user->password);
            }
            // unset($this->user->rolesName);
            unset($this->user->password);
            $this->user->save();
        } catch (\Throwable $th) {
            //$this->showError($th->getMessage());
            $this->showError('Error creando el usuario');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Usuario actualizado correctamente');
        } else {
            $this->showSuccess('Usuario creado correctamente');
        }

        $this->closetModal();
        $this->dispatch('user-index:refresh');
        $this->user = new User();
    }






    public function closetModal()
    {

        $this->userModal = false;
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

    public function render()
    {
        return view('livewire.user.management');
    }
}
