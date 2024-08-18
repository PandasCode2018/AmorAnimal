<?php

namespace App\Livewire\Responsible;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Responsible;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\WithMessages;

class Management extends Component
{
    use WithFileUploads;
    use WithMessages;
    public $responsibleModal = false;
    public Responsible $responsible;
    public $companyId;
    public $userId;

    public function mount()
    {
        $this->responsible = new Responsible();
        $this->companyId = Auth::user()->company_id;
        $this->userId = Auth::id();
    }
    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Correo',
        'phone' => 'Teléfono',
        'address' => 'Dirección',
        'document_number' => 'Documento',
        'currenPassword' => 'Contraseña',
    ];

    public function rules()
    {
        $validationEmail = $this->responsible?->id ? 'nullable|email|unique:responsibles,email,' . $this->responsible?->id : 'nullable|email|unique:responsibles,email';
        $validationDocument = $this->responsible?->id ? 'nullable|numeric|digits_between:5,15|unique:responsibles,document_number,' . $this->responsible?->id : 'nullable|numeric|digits_between:5,15|unique:responsibles,document_number';

        return [
            'responsible.name' => 'required|string',
            'responsible.email' => $validationEmail,
            'responsible.phone' => 'required|numeric|digits_between:6,12',
            'responsible.address' => 'required|string|max:100',
            'responsible.document_number' => $validationDocument,
            'responsible.currentPassword' => 'nullable|string|min:8|max:12',

        ];
    }
    private function clearString()
    {
        $fillable = $this->responsible->getFillable();
        foreach ($fillable as $field) {
            $this->responsible->$field = is_string($this->responsible->$field) ? mb_strtolower(trim($this->responsible->$field)) : $this->responsible->$field;
            if (empty($this->responsible->$field)) {
                unset($this->responsible->$field);
            }
        }
    }
    public function store()
    {
        $this->validate();
        $isEdit = (bool) $this->responsible->id;
        
        try {
            $this->clearString();
            if (!$isEdit) {
                $this->responsible->password = bcrypt($this->responsible->document_number);
            } else {
                $this->responsible->password = bcrypt($this->responsible->currentPassword);
            }
            unset($this->responsible->currentPassword);
            $this->responsible->company_id = $this->companyId;
            $this->responsible->user_id = $this->userId;
            $this->responsible->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el responsable');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Responsable actualizado correctamente');
        } else {
            $this->showSuccess('Responsable creado correctamente');
        }
        $this->closeModal();
        $this->dispatch('responsible-index:refresh');
        $this->responsible = new Responsible();
    }

    #[On('openResponsibleModal')]
    public function openModal($responbibleUuid = '')
    {
        $this->responsible = new Responsible();
        $this->resetErrorBag();
        if (Uuid::isValid($responbibleUuid)) {
            $this->responsible = Responsible::uuid($responbibleUuid)->first();
        }

        $this->responsibleModal = true;
    }
    public function closeModal()
    {
        $this->responsibleModal = false;
    }
    public function render()
    {
        return view('livewire.responsible.management');
    }
}
