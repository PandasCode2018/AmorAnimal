<?php

namespace App\Livewire\Consultation;

use DateTime;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Consultation;
use App\Http\Traits\WithMessages;
use App\Models\query_status;
use Illuminate\Support\Facades\Auth;

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
    public $userId;
    public $selectedUuid;
    public  $estadoInicial = 1;
    public $animalId;


    public function mount()
    {
        $this->consultations = new Consultation();
        $this->doctores = User::select(true);
        $this->animales = Animal::select();
        $this->estadoConsulta = query_status::select();
        $this->companyId = Auth::user()->company_id;
        $this->userId = Auth::id();
    }

    protected $validationAttributes = [
        'doctor_id' => 'Doctor',
        'reason' => 'Motivo de la consulta',
        'note' => 'Observaciones',
        'date_time_query' => 'Fecha',
    ];

    public function rules()
    {
        return [
            'consultations.doctor_id' => 'required|exists:users,id',
            'consultations.reason' => 'nullable|string',
            'consultations.note' => 'nullable|string',
            'consultations.date_time_query' => 'required|after_or_equal:today',
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

        $this->validate();

        $dateTime = new DateTime($this->consultations->date_time_query);
        $this->consultations->date_time_query = $dateTime->format('Y-m-d H:i');

        $isEdit = (bool) $this->consultations->id;

        try {
            $this->clearString();

            $this->consultations->company_id = $this->companyId;
            $this->consultations->user_id = $this->userId;
            $this->consultations->query_status_id = $this->estadoInicial;
            $this->consultations->animal_id = $this->animalId;

            // validar que el id del animal no tenga una conculta activa para asi agrgar otra OPCION2
            // desactivar el boton de agregar consulta en el listado de animales si tiene una consulta activa OPCION1 
            $this->consultations->save();
        } catch (\Throwable $th) {

            $this->showError('Error creando el animal');
            return;
        }
        if ($isEdit) {
            $this->showSuccess('Consulta actualizado correctamente');
        } else {
            $this->showSuccess('Consulta creado correctamente');
        }
        $this->closeModal();
        $this->dispatch('consultation-index:refresh');
        $this->consultations = new Consultation();
    }

    #[On('openConsultaModal')]
    public function openModal($consultaUuid = '', $animalId = '')
    {
        $this->consultations = new Consultation();
        $this->animalId = $animalId;
        $this->resetErrorBag();
        if (Uuid::isValid($consultaUuid)) {
            $this->consultations = Consultation::uuid($consultaUuid)->first();
            $this->animalId = $this->consultations->animal_id;
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
