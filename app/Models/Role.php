<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{

    protected $fillable = ['name', 'guard_name', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function filter($search = '')
    {
        $query = static::query()->with('company', 'users')->withCount('users', 'permissions');
        $search = trim($search);
        if (strlen($search) > 0) {
            $query->where('name', 'like', "%$search%")
                ->orWhereHas('company', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        }

        $query->where('company_id', Auth::user()->company_id);

        return $query->orderByDesc('id');
    }
}
