<?php

namespace App\Livewire\AnimalSpecie;

use Ramsey\Uuid\Uuid;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AnimalSpecies;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Management extends Component
{

    # SEDEB REVISAR EL POR QUE NO RECRAGAR  O CIERRA MODLA EN LA FUNCIONALIDAD DE ESPECIE
    use WithMessages;

    public $especieModal = false;
    public AnimalSpecies $animalSpaecie;
    public $companyId;

    public function mount()
    {
        $this->animalSpaecie = new AnimalSpecies();
        $this->companyId = Auth::user()->company_id;
    }

    public function rules()
    {

        return ['animalSpaecie.name' => 'required|string|max:20|unique:animal_species,name,' . $this->animalSpaecie->id];
    }

    protected $validationAttributes = ['animalSpaecie.name' => 'Nombre'];


    #[On('openEspecieModal')]
    public function openModal($especieUuId = '')
    {
        $this->resetErrorBag();
        $this->animalSpaecie = new AnimalSpecies();
        if (Uuid::isValid($especieUuId)) {
            $this->animalSpaecie = AnimalSpecies::uuid($especieUuId)->first();
        }
        $this->especieModal = true;
    }

    public function closeModal()
    {
        $this->especieModal = false;
    }

    public function  store()
    {       
        abort_unless(Gate::any(['Crear especies', 'Editar especies']), 403);
        $this->validate();
        $isEdit = (bool) $this->animalSpaecie->id;
        try {
            $this->animalSpaecie->company_id = $this->companyId;
            $this->animalSpaecie->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el registro, comuníquese con  soporte.');
            return;
        }

        if ($isEdit) {
            $this->showSuccess('Nombre de la especie fue actualizado correctamente');
        } else {
            $this->showSuccess('Nombre de la especie  fue creado correctamente');
        }

        $this->resetErrorBag();
        $this->closeModal();
        $this->dispatch('animal-index:refresh');
        $this->animalSpaecie = new AnimalSpecies();
    }

    public function render()
    {
        return view('livewire.animal-specie.management');
    }
}
