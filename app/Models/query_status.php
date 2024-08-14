<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query_status extends Model
{
    use HasFactory;


    protected $table = 'query_status';
    protected $fillable = [
        'name_status'

    ];

    public function consulta()
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
