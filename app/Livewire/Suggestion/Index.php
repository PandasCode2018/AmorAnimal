<?php

namespace App\Livewire\Suggestion;

use Livewire\Component;
use App\Models\suggestion;
use Livewire\WithFileUploads;
use App\Http\Traits\WithMessages;
use App\Models\Evidencesuggestion;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    use WithFileUploads;
    use WithMessages;

    public $modulos = ['Inicio', 'Usuario', 'Roles', 'Responsables', 'Animales', 'Consulta', 'Historia', 'Auditoria'];
    public $imagen;
    public Suggestion $sugerencias;
    public $userId;
    public $companyId;
    public $imgEvidencia;

    public function mount()
    {

        $this->sugerencias = new Suggestion();
        $this->imgEvidencia =  new Evidencesuggestion();
        $this->companyId = Auth::user()->company_id;
        $this->userId = Auth::id();
    }

    protected $validationAttributes = [
        'module' => 'Modulo',
        'message' => 'Mensaje',
        'imgEvidence' => 'Evidnecias',
    ];

    public function rules()
    {
        return [
            'sugerencias.module' => 'required|string|max:30',
            'sugerencias.message' => 'required|string',

        ];
    }

    public function procesarGuardar($sugerenciaId)
    {
        $imagenes = $this->imagen;
        $this->validate(['imagen.*' => "nullable|image|max:2048"]);
        $rutaImagenes = [];

        if ($imagenes && is_array($imagenes)) {
            foreach ($imagenes as $imagen) {
                if ($imagen instanceof \Illuminate\Http\UploadedFile) {
                    $imageName = time() . '_' . uniqid() . '.' . $imagen->getClientOriginalExtension();
                    $imagen->storeAs('evidenciaMejoras', $imageName, 'public');
                    $rutaImagenes[] = 'img_sistema/evidenciaMejoras/' . $imageName;
                }
            }
            foreach ($rutaImagenes as $ruta) {
                $this->imgEvidencia->create([
                    'imgEvidence' => $ruta,
                    'suggestion_id' => $sugerenciaId,
                ]);
            }
        }
    }


    public function store()
    {
        $this->validate();
        try {

            $this->sugerencias->company_id = $this->companyId;
            $this->sugerencias->user_id = $this->userId;
            $this->sugerencias->save();
            $sugerenciaId = $this->sugerencias->id;
            $this->procesarGuardar($sugerenciaId);
        } catch (\Throwable $th) {
            $this->showError('Error enviando la sugerencia');
            return;
        }

        $this->showSuccess('sugerencia enviada de manera correctamente');
        $this->dispatch('sugerencia-index:refresh');
        $this->imagen = '';
        $this->sugerencias = new Suggestion();
    }

    public function render()
    {
        return view('livewire.Suggestion.index');
    }
}
