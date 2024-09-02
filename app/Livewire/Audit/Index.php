<?php

namespace App\Livewire\Audit;

use App\Http\Traits\withTours;
use App\Models\Audit;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use withTours;

    public ?string $search = '';

    public $perPage = 8;

    protected $queryString = ['search'];

    protected $listeners = ['Audit-index:refresh' => 'refresh'];

    public function getAuditsQueryProperty()
    {
        return Audit::filter($this->search);
    }

    public function getAuditsProperty()
    {
        return $this->auditsQuery->paginate($this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('tutorialAuditoria')]
    public function tutorial()
    {
        $steps = config('MessageTour.auditoria');
        if (empty($steps)) {
            $this->showWarning('Lo sentimos, error con los mensajes del tutorial, comuníquese soporte.');
            return;
        }
        $this->showInicio($steps);
    }
    public function render()
    {
        return view('livewire.Audit.index');
    }
}
