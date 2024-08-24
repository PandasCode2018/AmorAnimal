<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class Audit extends ModelsAudit
{


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $user = Auth::user();
            $model->company_id = $user ? $user->company_id : null;
            // $model->company_id = Auth::user()->company_id ?? null;
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function filter($search = '')
    {
        $query = static::query();
        $search = trim($search);

        $query->selectRaw('audits.*,
                                CASE
                                    WHEN event = "updated" THEN "Actualización"
                                    WHEN event = "created" THEN "Creación"
                                    WHEN event = "deleted" THEN "Eliminación"
                                    WHEN event = "restored" THEN "Restauración"
                                ELSE
                                event END as event')
            ->where('company_id', Auth::user()->company_id)
            ->when(strlen($search) > 0, function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhere('event', 'like', "%$search%")
                    ->orWhereRaw('CASE WHEN event = "updated" THEN "Actualización" WHEN event = "created" THEN "Creación" WHEN event = "deleted" THEN "Eliminación" WHEN event = "restored" THEN "Restauración" ELSE event END like ?', ["%$search%"])
                    ->orWhere('auditable_type', 'like', "%$search%")
                    ->orWhere('ip_address', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%")
                    ->orWhere('updated_at', 'like', "%$search%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
            });

        return $query->orderByDesc('id');
    }
}
