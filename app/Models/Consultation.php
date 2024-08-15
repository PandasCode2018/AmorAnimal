<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Consultation extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    public const ACTIVO = 1;
    public const INACTIVO = 0;
    public const CANCELADO = 'Cancelada';
    public const FINALIZADO = 'Finalizada';


    protected $fillable = [
        'company_id',
        'animal_id',
        'doctor_id',
        'query_status_id',
        'reason',
        'note',
        'date_time_query',
        'user_id'
    ];


    public function company()
    {

        return $this->belongsTo(Company::class);
    }

    public function animal()
    {

        return $this->belongsTo(Animal::class);
    }

    public function queryStatus()
    {

        return $this->belongsTo(Query_status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userDoctor()
    {
        return $this->belongsTo(User::class, 'user_id')->where('bool_doctor', true);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public static function filter($search, $boolAll = false)
    {

        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
            # code...
        }
        if ($boolAll == false) {
            $query->where('company_id', auth()->user()->company_id)
                ->whereNotIn('query_status_id', [4, 2]);
        }

        return $query->with('company', 'animal', 'user', 'queryStatus', 'treatments')->orderByDesc('consultations.id');
    }
}
