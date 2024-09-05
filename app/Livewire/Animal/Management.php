<?php

namespace App\Livewire\Animal;

use Ramsey\Uuid\Uuid;
use App\Models\Animal;
use App\Models\Company;
use Livewire\Component;
use App\Models\Responsible;
use Livewire\Attributes\On;
use App\Models\AnimalSpecies;
use Livewire\WithFileUploads;
use App\Http\Traits\WithMessages;
use App\Models\PhoteAnimals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Management extends Component
{
    use WithFileUploads, WithMessages;

    public $animalModal = false;
    public Animal $animal;
    public $company;
    public $companyId;
    public $selectResponsable;
    public $selectEspecies;
    public $imagenAnimalActaul = [];
    public $image;
    public $prueba;
    public $sexoAnimal = ['Macho', 'Hembra', 'Hermafroditismo', 'Dioico', 'Monoico'];
    public $animalId;
    public $carpetaCompany;
    public $photeAnimal;
    public function mount()
    {
        $this->animal = new Animal();
        $this->companyId = Auth::user()->company_id;
        $this->company = Company::find($this->companyId);
        $this->selectResponsable = Responsible::select();
        $this->selectEspecies = AnimalSpecies::select();
        $this->photeAnimal = new PhoteAnimals();
        $this->carpetaCompany = $this->company->folder;
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
            'animal.weight' => 'nullable|numeric|max:10000',
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

    public function saveFile(array $files, int $animalId): void
    {
        $nameCarpeta = $this->carpetaCompany;
        $rutaBase = "empresas/{$nameCarpeta}/animales/";
        foreach ($files as $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs($rutaBase, $imageName, 'public');
                $this->photeAnimal->create([
                    'photeAnimal' => $rutaBase . $imageName,
                    'animal_id' => $animalId,
                ]);
            }
        }
    }

    public function store()
    {
        abort_unless(Gate::any(['Crear animals', 'Editar animals']), 403);
        $this->validate();
        $isEdit = (bool) $this->animal->id;
        $files = is_array($this->image) ? $this->image : [$this->image];
        try {
            if (!$isEdit) {
                $this->animal->code_animal = $this->generateCode($this->animal->name);
            }
            $this->clearString();

            $this->animal->company_id = $this->companyId;
            $this->animal->save();
            $animalId  = $this->animal->id;
            $this->saveFile($files, $animalId);
        } catch (\Throwable $th) {
            $this->showError('Error creando el registro, comuníquese con  soporte.');
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
            $this->imagenAnimalActaul = $this->photeAnimal::where('animal_id',$this->animal->id)->get();
        }
        $this->animalModal = true;
    }

    public function closeModal()
    {
        $this->animalModal = false;
        $this->image = [];
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
