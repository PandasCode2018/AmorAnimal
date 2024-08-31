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

    protected $fillable = [
        'company_id',
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

    public static function filter($search, $boolAll = false)
    {

        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
            $query->whereHas('animal', function ($infAnimal) use ($search) {
                $infAnimal->where('name', 'like', "%{$search}%")
                    ->orWhere('microchip_code', 'like', "%{$search}%")
                    ->orWhere('code_animal', 'like', "%{$search}%")
                    ->orWhereHas('responsible', function ($infoResponsable) use ($search) {
                        $infoResponsable->where('name', 'like', "%{$search}%")
                            ->orWhere('document_number', 'like', "%{$search}%");
                    });
            });
        }
        if ($boolAll == false) {
            $query->where('company_id', auth()->user()->company_id)
                ->whereNotIn('query_status_id', [3, 4]);
        }

        return $query->with('company', 'animal','queryStatus', 'treatments', 'doctor')->orderByDesc('consultations.id');
    }
}
