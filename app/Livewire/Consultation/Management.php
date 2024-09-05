<?php

namespace App\Livewire\Consultation;

use DateTime;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Consultation;
use App\Models\Query_status;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Management extends Component
{

    use WithMessages;
    public $consultaModal = false;
    public $estadosModal = false;
    public Consultation $consultations;
    public $doctores;
    public $animales;
    public $estadoConsulta;
    public $idConsultaActual;
    public $companyId;
    public $selectedUuid;
    public  $estadoInicial = 1;
    public $animalId;
    public $boolOcultar;
    public $tipoConsultas = ['Vacunación', 'Desparacitación', 'Estético', 'Tratamiento', 'Otro'];


    public function mount()
    {
        $this->consultations = new Consultation();
        $this->doctores = User::select();
        $this->animales = Animal::select();
        $this->estadoConsulta = Query_status::select();
        $this->companyId = Auth::user()->company_id;
    }

    protected $validationAttributes = [
        'doctor_id' => 'Doctor',
        'name' => 'Tipo de cunsulta',
        'reason' => 'Motivo de la consulta',
        'note' => 'Observaciones',
        'date_time_query' => 'Fecha',
    ];

    public function rules()
    {
        return [
            'consultations.doctor_id' => 'required|exists:users,id',
            'consultations.name' => 'required|string|max:100',
            'consultations.reason' => 'nullable|string',
            'consultations.note' => 'nullable|string',
            'consultations.date_time_query' => $this->consultations->id ? 'required|date' : 'required|date|after_or_equal:today'
        ];
    }

    private function clearString()
    {
        $fillable = $this->consultations->getFillable();

        foreach ($fillable as $field) {
            $this->consultations->$field = is_string($this->consultations->$field) ? mb_strtolower(trim($this->consultations->$field)) : $this->consultations->$field;
            if (empty($this->consultations->$field)) {
                unset($this->consultations->$field);
            }
        }
    }

    public function store()
    {
        abort_unless(Gate::any(['Crear consultations', 'Editar consultations']), 403);
        $this->validate();

        $dateTime = new DateTime($this->consultations->date_time_query);
        $this->consultations->date_time_query = $dateTime->format('Y-m-d H:i');

        $isEdit = (bool) $this->consultations->id;

        try {
            $this->clearString();

            if (!$isEdit) {
                $this->consultations->query_status_id = $this->estadoInicial;
            }

            $this->consultations->company_id = $this->companyId;
            $this->consultations->animal_id = $this->animalId;

            $this->consultations->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el registro, comuníquese con  soporte.');
            return;
        }
        if ($isEdit) {
            $this->showSuccess('Consulta actualizado correctamente');
        } else {
            $this->showSuccess('Consulta creado correctamente');
        }
        $this->dispatch('consultation-index:refresh');
        $this->closeModal();
        $this->consultations = new Consultation();
    }

    #[On('openConsultaModal')]
    public function openModal($consultaUuid = '', $animalId = '')
    {
        $this->consultations = new Consultation();
        $this->resetErrorBag();
        if (Uuid::isValid($consultaUuid)) {
            $this->consultations = Consultation::uuid($consultaUuid)->first();
            $this->animalId = $this->consultations->animal_id;
        }
        if ($animalId) {
            $this->boolOcultar = $animalId;
            $this->animalId = $animalId;
        }
        $this->consultaModal = true;
    }

    public function closeModal()
    {
        $this->consultaModal = false;
    }
    public function render()
    {
        return view('livewire.consultation.management');
    }
}
