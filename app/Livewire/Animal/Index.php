<?php

namespace App\Livewire\Animal;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithTableActions;
use App\Http\Traits\WithMessages;

class Index extends Component
{
    use WithPagination;
    use WithTableActions;
    use WithMessages;

    public $Animals;
    public ?string $search = '';
    public $perPage = 8;
    protected $queryString = ['search'];
    protected $listeners = ['animal-index:refresh' => 'refresh'];

    public function getAnimalsQueryProperty()
    {

        return Animal::filter($this->search);
    }

    public function getAnimalsProperty()
    {

        return $this->AnimalsQuery->paginate($this->perPage);
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.animal.index');
    }
}
