<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Query_status extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;


    protected $table = 'query_status';
    protected $fillable = [
        'name_status',
        'color',
        'orden'
    ];

    public function consultations()
    {

        return $this->hasMany(Consultation::class);
    }

    public static function select()
    {
        return  static::query()
            ->whereNull('deleted_at')
            ->select('id', 'name_status')
            ->get();
    }
}
