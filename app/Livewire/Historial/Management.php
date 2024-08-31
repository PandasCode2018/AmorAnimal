<?php

namespace App\Livewire\Historial;

use App\Models\Animal;
use Livewire\Component;
use App\Models\Responsible;
use Livewire\Attributes\On;
use App\Models\Consultation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Gate;

class Management extends Component
{
    use WithMessages;
    public $historialModal = false;
    public $animaId;
    public $animalId;
    public $responsableId;
    public $userCompanyId;
    public $informacionAnimal;
    public $infomacionResponsable;
    public $informacionConsultas;

    public function mount()
    {
        $this->userCompanyId = auth()->user()->company_id;
    }

    function isSetAndNotEmpty($variable)
    {
        return is_null($variable) && empty($variable);
    }
    public function getInfoAnimal($animaId)
    {
        return Animal::where('id', $animaId)
            ->where('company_id', $this->userCompanyId)
            ->get();
    }
    public function getInfoResponsable($responsableId)
    {
        return Responsible::where('id', $responsableId)
            ->where('company_id', $this->userCompanyId)
            ->get();
    }

    public function getInformacionConsulta($animalId)
    {
        return Consultation::with(['treatments', 'queryStatus', 'user'])
            ->where('animal_id', $animalId)
            ->orderByDesc('date_time_query')
            ->get();
    }

    #[On('openModalHistorial')]
    public function openModal($animalId, $responsableId)
    {
        if (empty($animalId) || empty($responsableId)) {
            $this->showWarning(' faltan datos par consultar el historial');
            return;
        }
        $this->historialModal = true;
        $this->animaId = $animalId;
        $this->responsableId = $responsableId;
        $this->informacionAnimal =  $this->getInfoAnimal($this->animaId);
        $this->infomacionResponsable =  $this->getInfoResponsable($this->responsableId);
        $this->informacionConsultas = $this->getInformacionConsulta($this->animaId);
    }

    public function closeModal()
    {
        $this->historialModal = false;
    }

    #[On('generatePdf')]
    public function dischargePdf($animalId, $responsableId)
    {
        Gate::authorize('Descargar historial');

        if ($this->isSetAndNotEmpty($animalId) || $this->isSetAndNotEmpty($responsableId)) {
            $this->showError('Error obteniendo datos, comuníquese con el administrador.');
            return;
        }

        $informacionAnimal =  $this->getInfoAnimal($animalId);
        $infomacionResponsable =  $this->getInfoResponsable($responsableId);
        $informacionConsultas = $this->getInformacionConsulta($animalId);

        if ($this->isSetAndNotEmpty($informacionAnimal) || $this->isSetAndNotEmpty($infomacionResponsable)) {
            $this->showError('Error obteniendo datos, comuníquese con el administrador.');
            return;
        }
        $historial = [
            'informacionAnimal' => $informacionAnimal,
            'infomacionResponsable' => $infomacionResponsable,
            'informacionConsultas' => $informacionConsultas,
        ];

        $pdf = Pdf::loadView('livewire.historial.generar-pdf', $historial);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Hitorial.pdf');
    }

    public function render()
    {
        return view('livewire.historial.management');
    }
}
