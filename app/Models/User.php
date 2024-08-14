<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use WithUuid;

    public const ACTIVO = 1;
    public const INACTIVO = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'document_number',
        'password',
        'phone',
        'address',
        'qualification',
        'specialty',
        'license_number',
        'years_experience',
        'profile_photo_path',
        'status',
        'bool_doctor',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function responsibles()
    {
        return $this->hasMany(Responsible::class);
    }
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
    public function animalSpecies()
    {
        return $this->hasMany(AnimalSpecies::class);
    }
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }


    public function getProfilePhotoUrlAttribute()
    {
        // Suponiendo que la foto de perfil está almacenada en el campo 'profile_photo_path'
        return $this->profile_photo_path;
    }

    public static function filter($search)
    {
        $query = static::query();
        $search = trim($search);

        if (strlen($search) > 0) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    /*   ->orWhereHas('roles', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    }) */
                    ->orWhereRaw("IF(status = 1, 'activo', 'inactivo') like '%$search%'");
            });
        }

        $query->where('company_id', auth()->user()->company_id);
        return $query->with('company')->orderByDesc('id');
    }

    public static function select($boolDoctor = '')
    {
        return static::query()
            ->whereNull('deleted_at')
            ->select('id', 'name')
            ->where('company_id', auth()->user()->company_id)
            ->where('status', self::ACTIVO)
            ->where('bool_doctor', self::ACTIVO)
            ->get();
    }
}
