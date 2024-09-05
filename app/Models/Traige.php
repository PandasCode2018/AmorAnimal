<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Traige extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    protected $fillable = [
        'company_id',
        'consultation_id',
        'condicion_corporal',
        'temperatura_corporal',
        'frecuencia_respiratoria',
        'relleno_capilar',
        'mucosa',
        'frecuencia_cardiaca',
        'llenado_capilar',
        'pulso',
        'numero_pardos',
        'esterelizado',
        'ultima_desparacitacion',
        'cirugias_previas',
        'esquema_vacunal',
        'tratamiento_reciente',
        'enfermedades_previas',
        'dieta',
    ];

    public function consultation()
    {

        return $this->belongsTo(Consultation::class);
    }
}
