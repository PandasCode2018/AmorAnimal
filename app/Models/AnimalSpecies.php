<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalSpecies extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    protected $fillable = [

        'company_id',
        'name',
        'status',
    ];

    public function animals()
    {

        return $this->hasMany(Animal::class);
    }

    public static function filter()
    {
        return static::query()
            ->where('company_id', auth()->user()->company_id)
            ->where('status', ACTIVO )
            ->orderByDesc('id');
    }

    public static function select()
    {
        return static::query()
            ->whereNull('deleted_at')
            ->select('id', 'name')
            ->where('company_id', auth()->user()->company_id)
            ->where('status', ACTIVO)
            ->get();
    }
}
