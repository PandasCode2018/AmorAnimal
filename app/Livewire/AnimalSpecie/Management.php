<?php

namespace App\Livewire\AnimalSpecie;

use Ramsey\Uuid\Uuid;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AnimalSpecies;
use App\Http\Traits\WithMessages;
use Illuminate\Support\Facades\Auth;

class Management extends Component
{

    # SEDEB REVISAR EL POR QUE NO RECRAGAR  O CIERRA MODLA EN LA FUNCIONALIDAD DE ESPECIE
    use WithMessages;

    public $especieModal = false;
    public AnimalSpecies $animalSpaecie;
    public $userId;
    public $companyId;

    public function mount()
    {
        $this->animalSpaecie = new AnimalSpecies();
        $this->userId = Auth::id();
        $this->companyId = Auth::user()->company_id;
    }

    public function rules()
    {

        return ['animalSpaecie.name' => 'required| string| max:20'];
    }

    protected $validationAttributes = ['animalSpaecie.name' => 'Nombre'];


    #[On('openEspecieModal')]
    public function openModal($especieUuId = '')
    {
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
        $this->validate();
        $isEdit = (bool) $this->animalSpaecie->id;
        try {
            $this->animalSpaecie->company_id = $this->companyId;
            $this->animalSpaecie->user_id = $this->userId;
            $this->animalSpaecie->save();
        } catch (\Throwable $th) {
            $this->showError('Error creando el nombre de la especie, comuníquese con  soporte.');
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
        $this->especieModal = new AnimalSpecies();
    }

    public function render()
    {
        return view('livewire.animal-specie.management');
    }
}
