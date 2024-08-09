<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


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
        'end_license'
    ];




    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function responsibles()
    {

        return $this->hasMany(Responsible::class);
    }
}
