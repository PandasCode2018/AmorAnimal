<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


// ! ACTUALMENTE AL REGISTRAR UNA EMPRESA NO DA UN ERROR Y AL PARCER ES POR EL LA LIBRERIA AUDITABLE SI LO RETIRAMOS FUNCIONA 
// ! SE DEBE BUSCAR LA FORMA DE QUE EL AUDI NO HAGA CASO CUANDO EL USUAIRO NO ESTA AUTENTICADO, SE DEBE HACER LO MISMO CON EL MODELO DE USER
class Company extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    protected $fillable = [
        'name_company',
        'nit',
        'email',
        'address',
        'phone',
        'status',
        'logo',
        'end_license',
        'bool_termino_codiciones',
        'folder',
    ];

   /*  protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->company_id = Auth::user()->company_id;
            } else {
                $model->disableAuditing();
            }
        });
    }

    public function shouldBeAudited()
    {
        return Auth::check();
    } */


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function responsibles()
    {
        return $this->hasMany(Responsible::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
