<?php

namespace App\Http\Traits;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Ramsey\Uuid\Uuid;

trait WithTableActions
{
    public function changeStatus($module, $modelUuid)
    {
        if (Gate::denies('edit ' . $module)) {
            $this->showError('No tienes permisos para realizar esta acción');
            return;
        }

        $model = null;
        switch ($module) {
            case 'companies':
                $model = Company::class;
                break;
            case 'users':
                $model = User::class;
                break;
            default:
                $this->showError('El modelo no existe.');
                return;
        }

        if (!Uuid::isValid($modelUuid)) {
            $this->showError('El registro no existe.');
            return;
        }

        $model = $model::uuid($modelUuid)->first();
        if (!$model) {
            $this->showError('Error al cambiar el estado del registro.');
            return;
        }
        $model->update(['status' => !$model->status]);
        $this->showSuccess('Estado modificado correctamente');
    }

    public function delete($module, $modelUuid)
    {
        /* if (Gate::denies('edit ' . $module)) {
            $this->showError('No tienes permisos para realizar esta acción');
            return;
        } */

        $model = null;
        switch ($module) {
            case 'companies':
                $model = Company::class;
                break;
            case 'users':
                if (auth()->user()->uuid == $modelUuid) {
                    $this->showError('No puedes eliminar tu propio usuario');
                    return;
                }
                $model = User::class;
                break;



            default:
                $this->showError('El modelo no existe.');
                return;
        }

        $record = $model::uuid($modelUuid)->first();

        if (!$record) {
            $this->showError('Error al intentar eliminar el registro.');
            return;
        }


        $record->delete();
        $this->showSuccess('Registro eliminado correctamente');
    }
}
