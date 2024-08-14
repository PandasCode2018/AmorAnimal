<?php

namespace App\Livewire\Consultation;

use App\Http\Traits\WithMessages;
use App\Http\Traits\WithTableActions;
use App\Models\Consultation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;
    use WithMessages;

    public Consultation $consultations;
    public ?string $search = '';
    public $perPage = 8;
    protected $queryString = ['search'];
    protected $listeners = ['consultation-index:refresh' => 'refresh'];

    public function getConsultationsQueryProperty()
    {

        return Consultation::filter($this->search);
    }

    public function getConsultationsProperty()
    {

        return $this->ConsultationsQuery->paginate($this->perPage);
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.consultation.index');
    }
}
