<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
/* 
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Asignar un valor temporal o nulo
            $model->company_id = null;
        });

        static::created(function ($model) {
            // Actualizar el valor de company_id si es necesario
            if (Auth::check()) {
                $model->company_id = Auth::user()->company_id;
                $model->save();
            }
        });
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
