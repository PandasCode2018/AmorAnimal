<?php

namespace App\Models;

use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsible extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'address',
        'document_number',
        'password',
        'user_id'
    ];


    public function company()
    {

        return $this->belongsTo(Company::class);
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
            $query->where(function ($texto) use ($search) {
                $texto->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%");
            });
        }
        $query->where('company_id', auth()->user()->company_id);
        return $query->with('company')->orderByDesc('id');
    }
}
