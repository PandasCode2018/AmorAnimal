<?php

namespace App\Livewire\Consultation;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Query_status;
use App\Http\Traits\WithMessages;
use App\Models\Consultation;

class Estado extends Component
{
    use WithMessages;
    public $estadosModal = false;
    public $estadoActual;
    public $consultaUuid;
    public $estados;
    public function render()
    {

        return view('livewire.consultation.estado');
    }
    #[On('openEstatusModal')]
    public function viewState($statusIdActual, $orden, $consultaUuid)
    {

        $this->mostrarEstados($orden);
        $this->estadosModal = true;
        $this->estadoActual = $statusIdActual;
        $this->consultaUuid = $consultaUuid;
    }

    public function mostrarEstados($orden)
    {
        $queryEstado = Query_status::query();
        $excluirEstados = [ESPERA];
        switch ($orden) {
            case ESPERA:
                $excluirEstados[] = FINALIZADA;
                $excluirEstados[] = POSTERGADO;
                break;
            case ATENCION:
                $excluirEstados[] = ATENCION;
                break;
            case POSTERGADO:
                $excluirEstados[] = ATENCION;
                $excluirEstados[] = POSTERGADO;
                break;
        }
        $queryEstado->whereNotIn('orden', $excluirEstados);
        $this->estados = $queryEstado->get();
    }

    #[On('modificarEstadoActual')]
    public function updateStatus($estadoId)
    {
        $consultaUuid = $this->consultaUuid;

        if (empty($estadoId) || empty($consultaUuid)) {
            $this->showError('faltan valores para cambiar el estado, comuniquese con el administrador ');
            return;
        }

        $consulta = Consultation::where('uuid', $consultaUuid)->first();
        if (!$consulta) {
            $this->showError('No se encontró la consulta especificada.');
            return;
        }
        try {
            $consulta->query_status_id = $estadoId;
            $consulta->save();
        } catch (\Exception $e) {
            $this->showError('Ocurrió un error al actualizar el estado de la consulta. Por favor, inténtelo de nuevo.');
            return;
        }

        $this->showSuccess('Estado actualizado correctamente.');
        $this->dispatch('consultation-index:refresh');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->estadosModal = false;
    }
}
