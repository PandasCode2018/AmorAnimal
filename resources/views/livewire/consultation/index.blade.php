@section('subhead')
    <title>Consultas - {{ config('app.name') }}</title>
@endsection
<div class="mx-2 bg-[#f3faf8] tourConsulta-0">
    <div class="mb-2 w-full">
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialConsultas')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y flex justify-center items-center shadow-sm rounded-lg">
                    <h2
                        class="font-serif font-semibold text-center text-3xl text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                        Consultas veterinarias
                    </h2>
                </div>
                <div
                    class="intro-y col-span-12 mt-2 flex items-center justify-between  border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 ">

                    <div class="relative w-56 text-slate-500 tourConsulta-1">
                        <x-input id="search"
                            title="Puedes realizar busquedas por: nombre del animal, codigo del animal, nombre del responsable, docuemento del responsable "
                            wire:model.live="search" class="!box w-56 pr-10 tooltip" type="search"
                            placeholder="Búscar..." />
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Animal</th>
                                        <th class="p-3 text-left">Responsable</th>
                                        <th class="p-3 text-left">Doctor</th>
                                        <th class="p-3 text-center">Fecha</th>
                                        <th class="p-3 text-center">Hora</th>
                                        @can('Editar consultas')
                                            <th class="p-3 text-center">Estado</th>
                                        @endcan
                                        @canany(['Editar consultas', 'ver tratamientos'])
                                            <th class="p-3 text-center">Acciones</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->Consultations as $consulta)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 text-left"> {{ $consulta->animal->name }}</td>
                                            <td class="p-3 text-left"> {{ $consulta->animal->responsible->name }}</td>
                                            <td class="p-3 capitalize text-left">{{ $consulta->doctor->name }}</td>
                                            <td class="p-3 text-center">
                                                {{ \Carbon\Carbon::parse($consulta->date_time_query)->format('Y-m-d') }}
                                            </td>
                                            <td class="p-3 text-center">
                                                {{ \Carbon\Carbon::parse($consulta->date_time_query)->format('h:i A') }}
                                            </td>
                                            @can('Editar consultas')
                                                <td class="p-3 tourConsulta-2">
                                                    <a wire:click="$dispatch('openEstatusModal',{statusIdActual: {{ $consulta->queryStatus->id }}, orden: '{{ $consulta->queryStatus->orden }}', consultaUuid: '{{ $consulta->uuid }}'})"
                                                        title="Cambio de estado">
                                                        <p
                                                            class="bg-{{ $consulta->queryStatus->color }}-400 cursor-pointer rounded p-1 text-sm text-white hover:bg-{{ $consulta->queryStatus->color }}-500">
                                                            {{ $consulta->queryStatus->name_status }}</p>
                                                    </a>
                                                </td>
                                            @endcan
                                            <td class="p-3">
                                                @if ($consulta->queryStatus->orden != 1)
                                                    @can('Ver tratamientos')
                                                        <a wire:click="$dispatch('indexTratamientoModal',{idConsulta: '{{ $consulta->id }}'})"
                                                            class="tourConsulta-3 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-green-500"
                                                            title="Agregar Tratamiento medico">
                                                            <i class="fas fa-syringe"></i>
                                                        </a>
                                                    @endcan
                                                    @can('Editar consultas')
                                                        <a wire:click="$dispatch('openConsultaModal', {consultaUuid:'{{ $consulta->uuid }}'})"
                                                            class="tourConsulta-4 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:cale-110"
                                                            title="Editar consulta">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="pt-5 text-center text-black dark:bg-darkmode-600 bg-transparent font-bold"
                                            colspan="100">
                                            No hay registros disponibles</td>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $this->Consultations->links() }}
    </div>
</div>

@push('modals')
    <livewire:consultation.management />
@endpush

@push('modals')
    <livewire:treatment.index />
@endpush

@push('modals')
    <livewire:consultation.estado />
@endpush
