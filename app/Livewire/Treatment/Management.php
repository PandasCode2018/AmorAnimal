<?php

namespace App\Livewire\Treatment;

use Ramsey\Uuid\Uuid;
use Livewire\Component;
use App\Models\Treatment;
use Livewire\Attributes\On;
use App\Models\Consultation;

class Management extends Component
{

    public Treatment $tratamiento;
    public $indexModal = false;
    public $tratamientoModal = false;
    public $idConsulta;
    public function mount()
    {

        $this->tratamiento = new Treatment();
    }


    protected $validationAttributes = [
        'drug_name' => 'Medicamento',
        'medicine_presentation' => 'Presentación',
        'application_date' => 'Fecha de dosis aplicada',
        'reinforcement_date' => 'Fecha de refuerzo',
        'dose' => 'Dosis',
        'frequency' => 'Frecuencia',
        'duration' => 'Dureación',
        'internal_or_external' => 'Interna o externa',
        'treatment_duration' => 'Duracion del tratamiento',
        'note' => 'Notas',
    ];

    public function rules()
    {
        return [
            'treatment.drug_name' => 'required|string|max:100',
            'treatment.medicine_presentation' => 'required:string|max:100',
            'treatment.application_date' => 'nullable|date|required|after_or_equal:now',
            'treatment.reinforcement_date' => 'nullable|date|required|after_or_equal:now',
            'treatment.dose' => 'nullable|string|max:30',
            'treatment.frequency' => 'nullable|string|max:30',
            'treatment.duration' => 'nullable|string|max:30',
            'treatment.internal_or_external' => 'nullable',
            'treatment.treatment_duration' => 'nullable|string|max:30',
            'treatment.note' => 'nullable',
        ];
    }

    #[On('openTratamientoModal')]
    public function openModal($tratamientoUuid = '')
    {
        $this->tratamiento = new Treatment();
        $this->resetErrorBag();
        if (Uuid::isValid($tratamientoUuid)) {
            $this->tratamiento = Treatment::uuid($tratamientoUuid)->first();
        }
        $this->tratamientoModal = true;
    }


    #[On('indexTratamientoModal')]
    public function openModalIndex($idConsulta)
    {
        $this->indexModal = true;
        $this->idConsulta = $idConsulta;
    }


    public function closeModal()
    {
        $this->tratamientoModal = false;
    }
    public function render()
    {
        return view('livewire.treatment.management');
    }
}
