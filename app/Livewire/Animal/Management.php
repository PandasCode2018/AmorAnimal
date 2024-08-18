<?php

namespace App\Livewire\Animal;

use Ramsey\Uuid\Uuid;
use App\Models\Animal;
use App\Models\AnimalSpecies;
use App\Models\Responsible;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Http\Traits\WithMessages;


class Management extends Component
{
    use WithFileUploads, WithMessages;

    public $animalModal = false;
    public Animal $animal;
    public $companyId;
    public $selectResponsable;
    public $selectEspecies;
    public $userId;
    public $imagePreview;
    public $image;
    public $prueba;
    public $sexoAnimal = ['Macho', 'Hembra', 'Hermafroditismo', 'Dioico', 'Monoico'];
    public $animalId;
    public $booColsulta = 1;
    public function mount()
    {
        $this->animal = new Animal();
        $this->userId = Auth::id();
        $this->companyId = Auth::user()->company_id;
        $this->selectResponsable = Responsible::select();
        $this->selectEspecies = AnimalSpecies::select();
    }

    # el campo quedo escrito de forma diferenet veririfcar con el responsible
    protected $validationAttributes = [
        'blood_type' => 'Tipo de sangre',
        'responsible_id' => 'Responsable',
        'animal_species_id' => 'Especie',
        'microchip_code' => 'Microchip',
        'animal_race' => 'Raza',
        'photo' => 'Foto',
        'name' => 'Nombre',
        'color' => 'Color',
        'weight' => 'Peso',
        'sex' => 'Sexo',
        'age' => 'Edad',
    ];

    public function rules()
    {
        return [
            'animal.responsible_id' => 'required|exists:responsibles,id',
            'animal.name' => 'required|string|max:100',
            'animal.color' => 'nullable|string|max:100',
            'animal.animal_species_id' => 'required|exists:animal_species,id',
            'animal.animal_race' => 'nullable|string|max:100',
            'animal.weight' => 'nullable|numeric|max:100',
            'animal.sex' => 'nullable|string|max:50',
            'animal.age' => 'nullable|numeric|max:1000',
            'animal.blood_type' => 'nullable|string|max:100',
            'animal.microchip_code' => 'nullable|string|max:100',
        ];
    }

    private function clearString()
    {
        $fillable = $this->animal->getFillable();
        foreach ($fillable as $field) {
            $this->animal->$field = is_string($this->animal->$field) ? mb_strtolower(trim($this->animal->$field)) : $this->animal->$field;
            if (empty($this->animal->$field)) {
                unset($this->animal->$field);
            }
        }
    }

    public function store()
    {
        $this->validate();
        $isEdit = (bool) $this->animal->id;
        $imagen = $this->image;

        if ($imagen && $imagen instanceof \Illuminate\Http\UploadedFile) {
            $imageName = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('animal', $imageName, 'public');
            $rutaImagen = 'animal/' . $imageName;
            $this->animal->photo = $rutaImagen;
        }
        try {

            if (!$isEdit) {
                $this->animal->code_animal = $this->generateCode($this->animal->name);
            }
            $this->clearString();

            $this->animal->company_id = $this->companyId;
            $this->animal->user_id = $this->userId;
            $this->animal->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el animal');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Animal actualizado correctamente');
        } else {
            $this->showSuccess('Animal creado correctamente');
        }
        $this->resetErrorBag();
        $this->closeModal();
        $this->dispatch('animal-index:refresh');
        $this->animal = new Animal();
    }

    #[On('openAnimalModal')]
    public function openModal($animalUuid = '')
    {
        $this->animal = new Animal();
        if (Uuid::isValid($animalUuid)) {
            $this->animal = Animal::uuid($animalUuid)->first();
        }
        $this->animalModal = true;
    }

    public function closeModal()
    {
        $this->animalModal = false;
        $this->image = '';
    }

    public function generateCode($name): string
    {
        $longitudEsperada = 10;
        $idEmpresa =  $this->companyId;
        $namePart = strtoupper(substr($name, 0, 3));
        $microtimePart = substr(microtime(false), 2, 6);
        $code = $namePart . $idEmpresa . $microtimePart;
        if (strlen($code) < $longitudEsperada) {
            $this->showSuccess('Error generando codigo, comuniquese con el administrador');
            exit;
        }
        return $code;
    }

    public function render()
    {
        return view('livewire.animal.management');
    }
}

/**
 * crear delete, sis e elimana un animal se eliminar toda su informacion asociada
 */
