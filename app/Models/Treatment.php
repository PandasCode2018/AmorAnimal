<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;


    protected $fillable = [

        'company_id',
        'consultation_id',
        'drug_name',
        'medicine_presentation',
        'application_date',
        'reinforcement_date',
        'dose',
        'frequency',
        'duration',
        'internal_or_external',
        'treatment_duration',
        'note',
        'user_id',
    ];


    public function company()
    {

        return $this->belongsTo(Company::class);
    }

    public function consultation()
    {

        return $this->belongsTo(Consultation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function filter($search)
    {

        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
        }


        $query->where('company_id', auth()->user()->company_id);
        if (!empty($uuidConsulta)) {
            $query->where('uuid', $uuidConsulta);
        }
        return $query->with('company', 'consultation', 'user')->orderByDesc('treatments.id');
    }
}
