<?php

namespace App\Livewire\Historial;

use App\Models\Animal;
use Livewire\Component;
use App\Models\Responsible;
use Livewire\Attributes\On;
use App\Models\Consultation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Traits\WithMessages;

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

        $this->informacionAnimal =  $this->getInfoAnimal($animalId);
        $this->infomacionResponsable =  $this->getInfoResponsable($responsableId);
        $this->informacionConsultas = $this->getInformacionConsulta($animalId);

        // Genera el PDF con los datos del animal
        $pdf = Pdf::loadView('historial.generar-pdf');

        // Descarga el PDF
        return $pdf->download('Historial.pdf');
    }

    public function render()
    {
        return view('livewire.historial.management');
    }
}
