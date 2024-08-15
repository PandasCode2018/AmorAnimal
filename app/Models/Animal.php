<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Animal extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    public const ACTIVO = 1;
    public const INACTIVO = 0;
    protected $fillable = [
        'company_id',
        'code_animal',
        'responsible_id',
        'name',
        'color',
        'animal_species_id',
        'animal_race',
        'weight',
        'sex',
        'age',
        'blood_type',
        'microchip_code',
        'photo',
        'user_id',
    ];


    public function campany()
    {

        return $this->belongsTo(Company::class);
    }

    public function responsible()
    {
        return $this->belongsTo(Responsible::class);
    }

    public function animalSpecies()
    {

        return $this->belongsTo(AnimalSpecies::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function constations()
    {

        return $this->hasMany(Consultation::class);
    }


    public static function filter($search)
    {

        $query = static::query();
        $search = trim($search);

        if (strlen($search) >  0) {
            $query->where(function ($texto) use ($search) {
                $texto->where('name', 'like', "%{$search}%")
                    ->orWhere('code_animal', 'like', "%{$search}%")
                    ->orWhere('animal_race', 'like', "%{$search}%")
                    ->orWhere('blood_type', 'like', "%{$search}%")
                    ->orWhere('microchip_code', 'like', "%{$search}%")
                    ->orWhere('age', 'like', "%{$search}%")
                    ->orWhere('sex', 'like', "%{$search}%")
                    ->orWhereHas('responsible', function ($responsable) use ($search) {
                        $responsable->where('name', 'like', "%{$search}%")
                            ->orWhere('document_number', 'like', "%{$search}%");
                    })
                    ->orWhereHas('animalSpecies', function ($esepcie) use ($search) {
                        $esepcie->where('name', 'like', "%{$search}%");
                    });
            });
        }
        $query->where('company_id', auth()->user()->company_id);
        return $query->with('responsible', 'AnimalSpecies', 'constations')->orderByDesc('animals.id');
    }

    public static function select()
    {
        return static::query()
            ->whereNull('deleted_at')
            ->select('id', 'name')
            ->where('company_id', auth()->user()->company_id)
            ->get();
    }
}
