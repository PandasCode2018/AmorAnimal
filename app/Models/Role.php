<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function filter($search = '', $company_id = null)
    {
        $query = static::query()->with('company', 'users')->withCount('users', 'permissions');
        $search = trim($search);
        if (strlen($search) > 0) {
            $query->where('name', 'like', "%$search%")
                ->orWhereHas('company', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        }

        /* if ($company_id) {
            $query->where('company_id', $company_id);
        } */

        return $query->orderByDesc('id');
    }
}
