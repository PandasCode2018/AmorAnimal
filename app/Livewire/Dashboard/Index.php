<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Animal;
use App\Models\Company;
use Livewire\Component;
use App\Models\Responsible;
use Livewire\Attributes\On;
use App\Models\Consultation;
use App\Http\Traits\WithTours;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithTours;
    public $totalAnimales = 0;
    public $totalConsultasHoy = 0;
    public $totalConsultas = 0;
    public $totalResponsables = 0;
    public $limiteLicencia;


    public function mount()
    {

        $companyUser = Auth::user()->company_id;
        $this->totalAnimales = Animal::where('company_id', $companyUser)->count() ?? 'Error';

        $this->totalConsultasHoy = Consultation::where('company_id', $companyUser)
            ->whereDate('date_time_query', \Carbon\Carbon::today())
            ->count() ?? 'Error';


        $this->totalConsultas = Consultation::where('company_id', $companyUser)->count() ?? 'Error';

        $this->totalResponsables = Responsible::where('company_id', $companyUser)->count() ?? 'Error';
        $this->limiteLicencia = Company::where('id', $companyUser)->pluck('end_license')->first() ?? 'Error';
    }


    #[On('tutorialDashboard')]
    public function tutorial()
    {
        $steps = config('MessageTour.dashboar');
        $this->showInicio($steps);
    }
    
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
