<?php

namespace App\Livewire\Treatment;

use Ramsey\Uuid\Uuid;
use Livewire\Component;
use App\Models\Treatment;
use Livewire\Attributes\On;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Auth;

class Management extends Component
{

    use WithMessages;

    public Treatment $treatment;
    public $tratamientoModal = false;
    public $companyId;
    public $userId;
    public $idConsulta;
    public $internaOexterna = ['0' => 'Interna', '1' => 'Externa'];
    public $presentaciones = [
        'Tabletas',
        'Cápsulas',
        'Suspensiones Líquidas',
        'Unguentos y Cremas',
        'Inyecciones',
        'Polvos',
        'Geles',
        'Pastas',
    ];
    public function mount()
    {
        $this->treatment = new Treatment();
        $this->userId = Auth::id();
        $this->companyId = Auth::user()->company_id;
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
            'treatment.medicine_presentation' => 'required|string|max:100',
            'treatment.application_date' => 'required|date|after_or_equal:today',
            'treatment.reinforcement_date' => 'nullable|date|after_or_equal:today',
            'treatment.dose' => 'required|string|max:30',
            'treatment.frequency' => 'nullable|string|max:30',
            'treatment.internal_or_external' => 'nullable',
            'treatment.treatment_duration' => 'nullable|string|max:30',
            'treatment.note' => 'nullable',
        ];
    }


    private function clearString()
    {
        $fillable = $this->treatment->getFillable();
        foreach ($fillable as $field) {
            $this->treatment->$field = is_string($this->treatment->$field) ? mb_strtolower(trim($this->treatment->$field)) : $this->treatment->$field;
            if (empty($this->treatment->$field)) {
                unset($this->treatment->$field);
            }
        }
    }

    public function store()
    {
        $this->validate();
        $isEdit = (bool) $this->treatment->id;
        try {
            $this->treatment->company_id = $this->companyId;
            $this->treatment->user_id = $this->userId;
            $this->treatment->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el tratamiento');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Tratamiento actualizado correctamente');
        } else {
            $this->showSuccess('Tratamiento creado correctamente');
        }
        $this->resetErrorBag();
        $this->closeModal();
        $this->dispatch('teatment-index:refresh');
        $this->treatment = new Treatment();
    }


    #[On('openTratamientoModal')]
    public function openModal($tratamientoUuid = '')
    {
        $this->treatment = new Treatment();
        $this->resetErrorBag();
        if (Uuid::isValid($tratamientoUuid)) {
            $this->treatment = Treatment::uuid($tratamientoUuid)->first();
        }
        $this->tratamientoModal = true;
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
