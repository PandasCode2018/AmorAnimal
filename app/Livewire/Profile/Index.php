<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\On;
use App\Models\Company;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithFileUploads;
    use WithMessages;

    public User $user;
    public Company $company;
    public $companyId;
    public $imagePreview;
    public $contenedorUserVisibles = true;
    public $contenedorCompanyVisibles = false;
    public $logoPreview;

    public function mount()
    {
        $this->user = User::find(Auth::id());
        $this->companyId = $this->user->company_id;
        $this->company = $this->user->company;
    }

    public function viewContenedorCompany()
    {

        $this->contenedorCompanyVisibles = false;
        $this->contenedorUserVisibles = true;
    }
    public function viewContenedorUser()
    {

        $this->contenedorCompanyVisibles = true;
        $this->contenedorUserVisibles = false;
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

    public function getUserRules()
    {
        return [
            'user.name' => 'required|string:max:100|min:2',
            'user.email' => 'required|email|unique:users,email,' . $this->user?->id,
            'user.qualification' => 'required',
            'user.specialty' => 'required',
            'user.years_experience' => 'required',
            'user.license_number' => 'required',
            'user.address' => 'required|string:max:100,',
            'user.password' => 'nullable|string|min:8|max:12',
            'user.newPassword' => 'nullable|string|min:8|max:12',
            'user.phone' => 'required|numeric|digits_between:6,12',
            'user.document_number' => 'required|numeric|digits_between:8,22',
        ];
    }

    public function getCompanyRules()
    {
        return [
            'company.name_company' => 'required',
            'company.nit' => 'required',
            'company.email' => 'nullable|email|unique:companies,email,' . $this->company?->id,
            'company.address' => 'nullable|string',
            'company.phone' => 'required|unique:companies,phone,' . $this->company?->id,
            'company.logo' => 'nullable',
            'company.end_licencia' => 'required',
        ];
    }

    protected function rules()
    {
        return array_merge($this->getUserRules(), $this->getCompanyRules());
    }

    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    private function clearString(&$attribute)
    {
        // aplicar trim o null a los campos
        $fillable = $attribute->getFillable();
        foreach ($fillable as $field) {
            $attribute->$field = is_string($attribute->$field) ? mb_strtolower(trim($attribute->$field)) : $attribute->$field;
            if (empty($attribute->$field)) {
                unset($attribute->$field);
            }
        }
    }


    #[On('updateUser')]
    public function updateUserProfile()
    {
        $this->validate($this->getUserRules());

        try {
            $this->clearString($this->user);
            if ($this->user->currentPassword) {
                if (! Hash::check($this->user->currentPassword, $this->user->password)) {
                    $this->showError('La contraseña actual no coincide');
                    return;
                }

                if ($this->user->newPassword) {
                    $this->user->password = Hash::make($this->user->newPassword);
                }
            }

            unset($this->user->currentPassword);
            unset($this->user->newPassword);
            $this->user->save();
        } catch (\Throwable $th) {
            $this->showError('Error actualizando el usuario');
            return;
        }

        $this->showSuccess('Usuario actualizada correctamente');
        $this->contenedorUserVisibles = true;
        $this->resetErrorBag();
        $this->user->refresh();
    }

    #[On('updateCompany')]
    public function updateCompanyPerfile()
    {

        $this->validate($this->getCompanyRules());
        try {
            $this->clearString($this->company);
            $this->company->save();
        } catch (\Throwable $th) {
            $this->showError('Error actualizada correctamente');
            return;
        }

        $this->showSuccess('Empresa actualizada correctamente');
        $this->contenedorCompanyVisibles = true;
        $this->resetErrorBag();
        $this->company->refresh();
    }


    public function render()
    {
        return view('livewire.profile.index');
    }
}
