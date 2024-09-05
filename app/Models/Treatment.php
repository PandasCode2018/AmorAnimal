<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Treatment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;



    protected $fillable = [

        'company_id',
        'consultation_id',
        'drug_name',
        'medicine_presentation',
        'application_date',
        'reinforcement_date',
        'dose',
        'frequency',
        'internal_or_external',
        'treatment_duration',
        'note',
        'aplicado'
    ];


    public function company()
    {

        return $this->belongsTo(Company::class);
    }

    public function consultation()
    {

        return $this->belongsTo(Consultation::class);
    }

    public static function filter($search, $consultaid)
    {
        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
        }

        $query->where('company_id', auth()->user()->company_id)
            ->where('consultation_id', $consultaid);

        return $query->with('company', 'consultation')->orderByDesc('treatments.id');
    }
}
