<?php

namespace App\Livewire\Treatment;

use App\Http\Traits\WithMessages;
use App\Models\Consultation;
use App\Models\Traige;
use Livewire\Component;
use Ramsey\Uuid\Uuid;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Valoracion extends Component
{
    use WithMessages;

    public Traige $triage;
    public $consultaid;
    public $companyId;
    public $condicionCorporal = ['Extremadamente delgado', 'Muy delgado', 'Delgado', 'Peso ideal', 'Sobrepeso', 'Obeso', ' Extremadamente obeso'];
    public $mucosa = ['Rosada y húmeda', 'Pálida', 'Cianótica', 'Ictérica', 'Hiperémica', 'Seca', 'Congestionada'];
    public $pulsos = ['Normal', 'Fuerte y regular', 'Débil', 'Rápido', 'Lento', 'Irregular', 'Ausente'];


    public function mount()
    {
        $this->triage = new Traige();
        $this->companyId = Auth::user()->company_id;
    }

    protected $validationAttributes = [

        'condicion_corporal' => 'Condición corporal',
        'temperatura_corporal' => 'Temperatura corporal',
        'frecuencia_respiratoria' => 'Frecuencia respiratoria',
        'relleno_capilar' => 'Tiempo de relleno capilar',
        'mucosa' => 'Mucosa',
        'frecuencia_cardiaca'  => 'Frecuencia cardíaca',
        'llenado_capilar'  => 'Tiempo de llenado capilar',
        'pulso'  => 'Pulso',
        'numero_pardos' => 'Numero de pardos',
        'esterelizado' => 'Esterilizado',
        'ultima_desparacitacion'  => 'Ultima desparacitación y producto',
        'cirugias_previas'  => 'Cirugías previas',
        'esquema_vacunal'  => 'Esquema vacunal',
        'tratamiento_reciente'  => 'Tratamiento recientes',
        'enfermedades_previas'  => 'Enfermedades previas',
        'dieta'  => 'Dieta',
    ];

    public function rules()
    {

        return [
            'triage.consultation_id' => 'nullable',
            'triage.condicion_corporal' => 'nullable|string|max:30',
            'triage.temperatura_corporal' => 'nullable|regex:/^\d{1,2}(\.\d{1})?$/',
            'triage.frecuencia_respiratoria' => 'nullable|numeric|max:1000',
            'triage.relleno_capilar' => 'nullable|regex:/^[0-9]{1,}[<>]?$/',
            'triage.mucosa' => 'nullable|string|max:30',
            'triage.frecuencia_cardiaca' => 'nullable|numeric|max:1000',
            'triage.llenado_capilar' => 'nullable|numeric|max:100',
            'triage.pulso' => 'nullable|string|max:30',
            'triage.numero_pardos' => 'nullable|numeric|max:10',
            'triage.esterelizado' => 'nullable|numeric|max:10',
            'triage.ultima_desparacitacion' => 'nullable|string|max:1000',
            'triage.cirugias_previas' => 'nullable|string|max:1000',
            'triage.esquema_vacunal' => 'nullable|string|max:1000',
            'triage.tratamiento_reciente' => 'nullable|string|max:1000',
            'triage.enfermedades_previas' => 'nullable|string|max:1000',
            'triage.dieta' => 'nullable|string|max:1000',
        ];
    }


    public function store()
    {

        abort_unless(Gate::any(['Crear treatments', 'Editar treatments']), 403);
        $this->validate();
        try {
            $this->triage->company_id = $this->companyId;
            $this->triage->consultation_id = $this->consultaid;
            $this->triage->save();
            $this->showSuccess('Triage actualizado correctamente');
        } catch (\Throwable $th) {
            $this->showError('Error creando el registro, comuníquese con  soporte.');
            return;
        }

        $this->dispatch('consultation-index:refresh');
        $this->closeModal();
        $this->triage = new Traige();
    }

    public $triageModal = false;

    #[On('openModalTriage')]
    public function opneModal($consultaUuid, $triageid)
    {

        $this->triage = new Traige();
        if (!Uuid::isValid($consultaUuid)) {
            $this->showWarning('Error con la consulta');
            return;
        }

        $consulta = Consultation::uuid($consultaUuid)->first();
        if (empty($consulta)) {
            $this->showWarning('Error con la consulta');
            return;
        }
        $triage = Traige::where('consultation_id', $consulta->id)
            ->where('id', $triageid)
            ->first();

        if (is_null($triage)) {
            $this->triage = new Traige();
        } else {
            $this->triage = $triage;
        }

        $this->consultaid =  $consulta->id;
        $this->triageModal = true;
    }
    public function closeModal()
    {

        $this->triageModal = false;
    }
    public function render()
    {
        return view('livewire.treatment.Valoracion');
    }
}
