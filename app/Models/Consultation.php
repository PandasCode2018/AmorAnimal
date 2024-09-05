<?php

namespace App\Models;

use Carbon\Carbon;
use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    protected $fillable = [
        'company_id',
        'name',
        'animal_id',
        'doctor_id',
        'query_status_id',
        'reason',
        'note',
        'date_time_query',
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
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->where('bool_doctor', true);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function triage()
    {
        return $this->hasOne(Traige::class, 'consultation_id', 'id');
    }

    public static function filter($search, $boolAll = false)
    {
        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
            $query->where(function ($texto) use ($search) {
                $texto->where('name', 'like', "%{$search}%")
                    ->orWhereHas('animal', function ($infAnimal) use ($search) {
                        $infAnimal->where('name', 'like', "%{$search}%")
                            ->orWhere('microchip_code', 'like', "%{$search}%")
                            ->orWhere('code_animal', 'like', "%{$search}%")
                            ->orWhereHas('responsible', function ($infoResponsable) use ($search) {
                                $infoResponsable->where('name', 'like', "%{$search}%")
                                    ->orWhere('document_number', 'like', "%{$search}%");
                            });
                    })
                    ->orWhereHas('queryStatus', function ($estado) use ($search) {
                        $estado->where('name_status', 'like', "%{$search}%");
                    })->orWhereRaw('CASE 
                        WHEN query_status_id = 1 THEN "Espera"
                        WHEN query_status_id = 2 THEN "Atención"
                        WHEN query_status_id = 3 THEN "Cancelado"
                        WHEN query_status_id = 4 THEN "Finalizado"
                        WHEN query_status_id = 5 THEN "Postergado"
                        ELSE query_status_id
                            END like ?', ["%$search%"]);
            });
        }
        if ($boolAll == false) {
            $query->where('company_id', auth()->user()->company_id)
                ->whereNotIn('query_status_id', [3, 4]);
        }

        // Agregar el marcador en la consulta
        $query->with('company', 'animal', 'queryStatus', 'treatments', 'doctor', 'triage')
            ->select('*')
            ->selectRaw('(CASE 
              WHEN EXISTS (
                  SELECT 1 FROM treatments
                  WHERE treatments.consultation_id = consultations.id
                  AND treatments.reinforcement_date IS NOT NULL
                  AND treatments.reinforcement_date BETWEEN ? AND ?
              )
              THEN 1 ELSE 0 END) AS boolProximacita', [
                Carbon::now()->startOfDay(), // Fecha actual (inicio del día)
                Carbon::now()->addWeek()->endOfDay() // Fecha una semana desde ahora (fin del día)
            ])
            ->orderByDesc('consultations.id');

        return $query;
    }
}
