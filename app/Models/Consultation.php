<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use WithUuid;

    public const ACTIVO = 1;
    public const INACTIVO = 0;

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

    public function queryStatu()
    {

        return $this->belongsTo(query_status::class);
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

    public static function filter($search)
    {

        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
            # code...
        }

        $query->where('company_id', auth()->user()->company_id);
        return $query->with('company', 'animal', 'user', 'queryStatu')->orderByDesc('consultations.id');
    }
}
