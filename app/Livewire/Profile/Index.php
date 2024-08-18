<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public $name;
    public $nameCompany;
    protected $listeners = ['profile-index:refresh' => 'refresh'];

    public function mount()
    {
        $this->company = Company::find(Auth::id());
        $this->user = User::find(Auth::id());
        $this->companyId = $this->user->company_id;
        $this->name = $this->user->name;
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


    private function processImage(&$attribute, $folder, $validation)
    {
        $image = $attribute->image;
        $imageOriginal = $attribute->getOriginal('image');
        if ($attribute->getOriginal('image') != $image || empty($attribute->id)) {
            $attribute->image = '';
            if ($image instanceof \Illuminate\Http\UploadedFile) {
                $this->validate($validation);
                $attribute->image = $image->store($folder, 'public');
            }

            if ($attribute->id) {
                $originalImage = $imageOriginal ?? '';
                if (Storage::disk('public')->exists($originalImage)) {
                    Storage::disk('public')->delete($originalImage);
                }
            }
        }
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
            'user.profile_photo_path' => 'nullable'
        ];
    }

    public function getCompanyRules()
    {
        return [
            'company.name_company' => 'required',
            'company.nit' => 'required',
            'company.email' => 'nullable|email|unique:companies,email,' . $this->company?->id,
            'company.address' => 'nullable|string',
            'company.phone' => ['required', Rule::unique('companies', 'phone')->ignore($this->company->id)],
            'company.logo' => 'nullable',
            'company.end_license' => 'required',
        ];
    }

    protected function rules()
    {
        return array_merge($this->getUserRules(), $this->getCompanyRules());
    }

    public function updatedImage()
    {
        $this->imagePreview = $this->user->profile_photo_path->temporaryUrl();
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
        $this->validate($this->getUserRules());

        try {
            $imagen = $this->user->profile_photo_path;
            if ($imagen && $imagen instanceof \Illuminate\Http\UploadedFile) {
                $imageName = time() . '.' . $imagen->getClientOriginalExtension();
                $imagen->storeAs('Pandas', $imageName, 'public');
                $rutaImagen = 'Pandas/' . $imageName;
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
    }

    public function updateCompanyPerfile()
    {

        $this->validate($this->getCompanyRules());
        try {
            $logo = $this->company->logo;
            if ($logo && $logo instanceof \Illuminate\Http\UploadedFile) {
                $imageName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->storeAs('Pandas', $imageName, 'public');
                $rutaImagen = 'Pandas/' . $imageName;
                $this->company->logo = $rutaImagen;
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
    }


    public function render()
    {
        return view('livewire.profile.index');
    }
}


/**
 * Revisar si se puede aplicar validaciones con rule
 * revisar la previsuañizacion de las imaganes
 */

/* 'status' => [
    'required',
    Rule::in(['active', 'inactive']),
], */