<?php

namespace App\Livewire\Historial;

use App\Http\Traits\WithMessages;
use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Consultation;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;

class Tratamiento extends Component
{

    use WithMessages;


    public $tipoTratamiento;
    public $animaId;
    public $informacionAnimal;
    public $infomacionTrataminto;
    public $userCompanyId;
    public $modalTratamientoFreacion = false;
    public $tipoConsultas = ['Vacunación', 'Desparacitación', 'Estético', 'Tratamiento', 'Otro'];


    public function mount()
    {

        $this->userCompanyId = Auth::user()->company_id;
    }

    public function getInfoAnimal($animaId)
    {
        return Animal::where('id', $animaId)
            ->where('company_id', $this->userCompanyId)
            ->get();
    }

    public function getInformacionConsulta($animalId, $tipoConsulta)
    {
        return Treatment::with(['consultation' => function ($query) use ($animalId, $tipoConsulta) {
            $query->where('animal_id', $animalId)
                ->where('name', $tipoConsulta)
                ->whereNull('deleted_at')
                ->where('company_id', $this->userCompanyId);
        }])
            ->whereHas('consultation', function ($query) use ($animalId, $tipoConsulta) {
                $query->where('animal_id', $animalId)
                    ->where('name', $tipoConsulta)
                    ->whereNull('deleted_at')
                    ->where('company_id', $this->userCompanyId);
            })
            ->whereNull('deleted_at')
            ->orderByDesc('application_date')
            ->get();
    }

    #[On('VerDetalleTratamientoFreacion')]
    public function openModal($animalId, $tipoTratamiento)
    {
        $this->showWarning('Esta funcionalidad está en proceso de construcción, será liberada actualización.');
        return;

        if (empty($animalId) || empty($tipoTratamiento)) {
            $this->showWarning(' faltan datos par consultar el historial');
            return;
        }

        $this->animaId = $animalId;
        $this->informacionAnimal =  $this->getInfoAnimal($this->animaId);
        $this->infomacionTrataminto =  $this->getInformacionConsulta($this->animaId, $tipoTratamiento);
        $this->tipoTratamiento = $tipoTratamiento;
        $this->modalTratamientoFreacion = true;
    }


    public function closeModal()
    {
        $this->modalTratamientoFreacion = false;
    }



    public function render()
    {
        return view('livewire.historial.tratamiento');
    }
}
