<?php

namespace App\Http\Traits;

use App\Models\Role;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Animal;
use App\Models\Company;
use App\Models\Responsible;
use App\Models\AnimalSpecies;
use App\Http\Traits\WithMessages;
use App\Models\Consultation;
use Illuminate\Support\Facades\Gate;

trait WithTableActions
{

    use WithMessages;
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
            case 'animalEspecies':

                $especie = AnimalSpecies::where('uuid', $modelUuid)->first();
                if ($especie && Animal::where('animal_species_id', $especie->id)->exists()) {
                    $this->showWarning('No puedes eliminar, esta asociado a otro registro');
                    return;
                }
                $model = AnimalSpecies::class;
                break;

            case 'animals':

                $animal = Animal::where('uuid', $modelUuid)->first();
                if ($animal && Consultation::where('animal_id', $animal->id)->Exists()) {
                    $this->showWarning('No puedes eliminar, esta asociado a otro registro');
                    return;
                }
                $model = Animal::class;
                break;

            case 'responsibles':

                $responsible = Responsible::where('uuid', $modelUuid)->first();
                if ($responsible && Animal::where('responsible_id', $responsible->id)->exists()) {
                    $this->showWarning('No puedes eliminar, esta asociado a otro registro');
                    return;
                }
                $model = Responsible::class;
                break;

            case 'role':
                $model = Role::class;
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

        if ($module == 'role') {
            if (!$record || $record->users()->count() > 0) {
                $this->showError('Rol no encontrado o tiene usuarios asociados');
                return;
            }
        }

        $record->delete();
        $this->showSuccess('Registro eliminado correctamente');
    }
}
