<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
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
    public $totalConsultasPsotergadas = 0;
    public $totalConsultas = 0;
    public $totalResponsables = 0;
    public $limiteLicencia;


    public function mount()
    {

        $companyUser = Auth::user()->company_id;
        $this->totalAnimales = Animal::where('company_id', $companyUser)->count() ?? 'Error';

     

            $this->totalConsultasPsotergadas = Consultation::where('company_id', $companyUser)
            ->whereIn('query_status_id', [2, 5]) // Filtra los estados 2 o 5
            ->whereHas('treatments', function ($query) {
                $query->whereNotNull('reinforcement_date') // Filtro para tratamientos con reinforcement_date no nulo
                      ->whereBetween('reinforcement_date', [
                          Carbon::now()->startOfDay(), // Fecha actual (inicio del día)
                          Carbon::now()->addWeek()->endOfDay() // Fecha una semana desde ahora (fin del día)
                      ]);
            })
            ->count() ?? 0;


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
