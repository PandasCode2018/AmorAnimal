<?php

namespace App\Livewire\Dashboard;

use App\Models\Animal;
use App\Models\Company;
use App\Models\Consultation;
use App\Models\Responsible;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
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
            ->where('user_id', Auth::id())
            ->whereDate('date_time_query', \Carbon\Carbon::today())
            ->count() ?? 'Error';


        $this->totalConsultas = Consultation::where('company_id', $companyUser)->count() ?? 'Error';

        $this->totalResponsables = Responsible::where('company_id', $companyUser)->count() ?? 'Error';
        $this->limiteLicencia = Company::where('id', $companyUser)->pluck('end_license')->first() ?? 'Error';
    }
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
