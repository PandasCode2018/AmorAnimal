<?php

namespace App\Livewire\Company;

use Exception;
use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class Managemen extends Component
{
    public Company $company;
    public $nitCompany;
    public $companyId;

    public function mount()
    {
        $this->company = new Company();
    }


    protected $validationAttributes = [
        'name_company' => 'Organización ',
        'nit' => 'Nit',
        'email' => 'Correo',
        'address' => 'Dirección',
        'phone' => 'Teléfono',
        'bool_termino_codiciones' => 'Politicas'
    ];

    public function rules()
    {
        return [
            'name_company' => 'required|string|max:100',
            'nit' => 'required|string|max:50|unique:companies,nit',
            'email' => 'required|string|max:50|unique:companies,email',
            'address' => 'nullable|string|max:100',
            'phone' => 'nullables|string|max:11',
            'bool_termino_codiciones' => 'required'
        ];
    }


    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->company->save();
            $companyId = $this->company->id;
            $companyNit = $this->company->nit;
            $companyName = $this->company->name_company;
            $this->createCarpetas($companyNit);
            $user = $this->createUser($companyId, $companyName);
            $userId = $user->id;
            $this->generarRolPermisos($companyId, $userId);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception('Ocurrió un error al guardar los datos: ' . $th->getMessage());
        }
    }


    public function createCarpetas($nitCompany)
    {
        $carpetaEmpresa = storage_path("app/public/empresas/{$nitCompany}");
        $carpetaAnimales = "{$carpetaEmpresa}/animales";
        $carpetaUsuarios = "{$carpetaEmpresa}/usuarios";

        if (!File::exists($carpetaEmpresa)) {
            File::makeDirectory($carpetaEmpresa, 0755, true);
        }

        if (!File::exists($carpetaAnimales)) {
            File::makeDirectory($carpetaAnimales, 0755, true);
        }

        if (!File::exists($carpetaUsuarios)) {
            File::makeDirectory($carpetaUsuarios, 0755, true);
        }
    }

    public function generarRolPermisos($companyId, $userId)
    {
        try {
            $role = Role::create(['name' => 'Arca']);
            $permissions = Permission::all();
            $role->syncPermissions($permissions);
            $user = User::findOrFail($userId);
            $user->assignRole($role);
        } catch (\Throwable $th) {
            throw new Exception('Ocurrió un error los permisos: ' . $th->getMessage());
        }
    }

    # verificar como crerar correro rando
    public function createUser($companyId, $companyName)
    {

        $microtimePart = substr(microtime(false), 2, 4);
        $email = $companyName . $companyId . $microtimePart . '@demo.com';
        try {
            $password = bcrypt('password');
            $user = User::create(['name' => 'Noe', 'email' => $email, 'password' => $password, 'company_id' => $companyId]);
            return $user;
        } catch (\Throwable $th) {
            throw new Exception('Ocurrió un error en el usuario: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.company.managemen');
    }
}
