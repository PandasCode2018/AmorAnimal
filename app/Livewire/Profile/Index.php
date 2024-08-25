<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProfileRequest;

class Index extends Component
{
    use WithFileUploads;
    use WithMessages;

    public User $user;
    public Company $company;
    public $companyId;
    public $imagenUser;
    public $imagenCompany;
    public $contenedorUserVisibles = true;
    public $contenedorCompanyVisibles = false;
    public $name;
    public $nameCompany;
    public $carpetaCompany;
    protected $listeners = ['profile-index:refresh' => 'refresh'];

    public function mount()
    {
        $this->user = User::find(Auth::id());
        $this->companyId = $this->user->company_id;
        $this->name = $this->user->name;
        $this->company = Company::find($this->companyId);
        $this->carpetaCompany = $this->company->folder;
    }

    public function viewContenedorCompany()
    {

        $this->contenedorCompanyVisibles = false;
        $this->contenedorUserVisibles = true;
        $this->resetErrorBag();
    }
    public function viewContenedorUser()
    {

        $this->contenedorCompanyVisibles = true;
        $this->contenedorUserVisibles = false;
        $this->resetErrorBag();
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
        'profile_photo_path' => 'Foto',
    ];

    public function getUserRules()
    {
        return [
            'user.name' => 'required|string|max:100|min:2',
            'user.email' => 'required|email|unique:users,email,' . $this->user?->id,
            'user.qualification' => 'nullable',
            'user.specialty' => 'nullable',
            'user.years_experience' => 'nullable',
            'user.license_number' => 'nullable',
            'user.address' => 'required|string|max:100',
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
            'company.phone' => 'required|numeric|digits_between:6,12|unique:companies,phone,' . $this->company?->id,
            'company.end_license' => 'required',
        ];
    }

    protected function rules()
    {
        return array_merge($this->getUserRules(), $this->getCompanyRules());
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
    public function updateUserProfile()
    {
        $nameCarpeta = $this->carpetaCompany;
        $this->validate($this->getUserRules());
        try {
            $imagen = $this->imagenUser;
            if ($imagen && $imagen instanceof \Illuminate\Http\UploadedFile) {
                $imageName = time() . '.' . $imagen->getClientOriginalExtension();
                $imagen->storeAs("empresas/{$nameCarpeta}" . '/usuarios/', $imageName, 'public');
                $rutaImagen = "empresas/{$nameCarpeta}" . '/usuarios/' . $imageName;

                if ($this->user->profile_photo_path) {
                    $oldImagePath = public_path("storage/{$this->user->profile_photo_path}");
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $this->user->profile_photo_path = $rutaImagen;
            }

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
            $this->showError('Error actualizada los datos');
            return;
        }

        $this->showSuccess('Usuario actualizada correctamente');
        $this->contenedorUserVisibles = true;
        $this->resetErrorBag();
        $this->dispatch('profile-index:refresh');
        $this->imagenUser = '';
    }

    public function updateCompanyPerfile()
    {
        $nameCarpeta =   $this->carpetaCompany;
        $this->validate($this->getCompanyRules());
        try {
            $logo = $this->imagenCompany;
            if ($logo && $logo instanceof \Illuminate\Http\UploadedFile) {
                $imageName = time() . '.' . $logo->getClientOriginalExtension();
                $carpetaEmpresa = "empresas/{$nameCarpeta}";
                $imagePath = "{$carpetaEmpresa}/{$imageName}";
                $logo->storeAs($carpetaEmpresa, $imageName, 'public');

                #eliminia la imagen existente
                if ($this->company->logo) {
                    $oldImagePath = public_path("storage/{$this->company->logo}");
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $this->company->logo = $imagePath;
            }

            $this->clearString($this->company);
            $this->company->save();
        } catch (\Throwable $th) {
            $this->showError('Error actualizada correctamente');
            return;
        }

        $this->showSuccess('Empresa actualizada correctamente');
        $this->contenedorUserVisibles = false;
        $this->resetErrorBag();
        $this->dispatch('profile-index:refresh');
        $this->imagenCompany = '';
    }


    public function render()
    {
        return view('livewire.profile.index');
    }
}
