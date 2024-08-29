<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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
            'status' => ACTIVO,

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
                'status' => $request->status,
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
            return redirect()->back()->with('success', 'Organización creada exitosamente. Su correo es <strong>' . $user->email . '</strong> y su clave es <strong>password</strong>. Puede cambiar estos datos una vez inicie sesión.');
            #Iniciar sesión automáticamente
            //Auth::login($user);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la creación de la organización, comuníquese con nuestra línea de atención.');
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
            $role = new Role();
            $role->name = 'Arca';
            $role->guard_name = 'web';
            $role->company_id = $companyId;
            $role->save();
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

            $user = new User();
            $user->company_id = $companyId;
            $user->name = 'Noe';
            $user->email = $email;
            $user->document_number = $companyNit;
            $user->password = Hash::make('password');
            $user->bool_doctor = ACTIVO;
            $user->status = ACTIVO;
            $user->save();

            if (!$user) {
                throw new Exception('No se pudo crear el usuario');
            }
            return $user;
        } catch (\Throwable $th) {
            throw new Exception('Ocurrió un error en el usuario: ' . $th->getMessage());
        }
    }
}
