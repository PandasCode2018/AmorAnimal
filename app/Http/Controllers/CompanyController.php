<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    public Company $company;
    public $nitCompany;
    public $companyId;
    public $newCompany;


    public function __construct()
    {
        $this->company = new Company();
    }

    public function index()
    {
        return view('guest.company.index');
    }

    public function store(StoreCompanyRequest $request)
    {
        $request->validated();
        $fecha_actual = date(YMD);
        $terminacionLicencia = date(YMD, strtotime($fecha_actual . "+ 90 days"));
        $request->merge([
            'end_license' => $terminacionLicencia,
            'bool_termino_codiciones' => ACTIVO,

        ]);
        DB::beginTransaction();
        try {
            $newCompany = Company::create([
                'name_company' => $request->name_company,
                'nit' => $request->nit,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'bool_termino_codiciones' => $request->bool_termino_codiciones,
                'end_license' => $request->end_license,
                'folder' => $request->nit,
            ]);
            if (!$newCompany) {
                throw new Exception('No se pudo crear la empresa');
            }

            $companyId = $newCompany->id;
            $companyNit = $newCompany->nit;
            $companyName = $newCompany->name_company;
            $this->createCarpetas($companyNit);
            $user = $this->createUser($companyId, $companyName, $companyNit);
            $userId = $user->id;
            $this->generarRolPermisos($companyId, $userId);
            DB::commit();
            return redirect()->route('login')->with('success', 'Organización creada exitosamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage(), $th->getTraceAsString());
            //return redirect()->back()->with('error', 'Error en la creación de la organización, comuníquese con nuestra línea de atención.');
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
        if (is_null($companyId) || is_null($userId)) {
            throw new Exception('Error en la asignación de permisos , comuniquese con nuestro liena de atencion');
        }
        try {
            $role = Role::create(['name' => 'Arca', 'guard_name' => 'web', 'company_id' => $companyId]);
            $permissions = Permission::all();
            $role->syncPermissions($permissions);
            $user = User::findOrFail($userId);
            $user->assignRole($role);
        } catch (\Throwable $th) {
            throw new Exception('Ocurrió un error los permisos: ' . $th->getMessage());
        }
    }


    public function createUser($companyId, $companyName, $companyNit)
    {
        if (is_null($companyId) || is_null($companyName) || is_null($companyNit)) {
            throw new Exception('Error en la creacion del usuario, comuniquese con nuestro liena de atencion');
        }
        $microtimePart = substr(microtime(false), 2, 4);
        $email = $companyName . $companyId . $microtimePart . '@amorAnimal.com';
        try {
            $newUser = User::create([
                'company_id' => $companyId,
                'name' => 'Noe',
                'email' => $email,
                'document_number' => $companyNit,
                'password' => bcrypt('password'),
                'bool_doctor' => ACTIVO
            ]);

            if (!$newUser) {
                throw new Exception('No se pudo crear el usuario');
            }
            return $newUser;
        } catch (\Throwable $th) {
            throw new Exception('Ocurrió un error en el usuario: ' . $th->getMessage());
        }
    }
}
