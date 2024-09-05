@section('subhead')
    <title>Historial medico - {{ config('app.name') }}</title>
@endsection
<div class="mx-2 bg-[#f3faf8] tourHistorial-0">
    <div class="mb-2 w-full">
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialHistorial')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y flex justify-center items-center shadow-sm rounded-lg">
                    <h2
                        class="font-serif font-semibold text-center text-3xl text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                        Historial de consultas
                    </h2>
                </div>
                <div
                    class="intro-y col-span-12 mt-2 flex justify-start border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 ">

                    <div class="tourHistorial-1 relative w-56 text-slate-500">
                        <x-input id="search" titleInput="Filtro para búscar animales" wire:model.live="search"
                            class="!box w-56 pr-10 tooltip" type="search" placeholder="Búscar..." />
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">identificacion</th>
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-center">Responsable</th>
                                        @can('Ver historial')
                                            <th class="p-3 text-center">Vacunación</th>
                                        @endcan
                                        @can('Ver historial')
                                            <th class="p-3 text-center">Desparacitación</th>
                                        @endcan
                                        @can('Ver historial')
                                            <th class="p-3 text-center">Hitorial</th>
                                        @endcan
                                        @can('Descargar historial')
                                            <th class="p-3 text-center">Descargar</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->animals as $animal)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 text-left">{{ $animal->code_animal }}</td>
                                            <td class="p-3  text-left"> {{ $animal->name }}</td>
                                            <td class="p-3 text-center"> {{ $animal->responsible->name }}</td>
                                            @can('Ver historial')
                                                <td> <a wire:click="$dispatch('VerDetalleTratamientoFreacion',{animalId:{{ $animal->id }}, tipoTratamiento:'Vacunacion'})"
                                                        class="tourHistorial-4 bg-slate-200 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-200"
                                                        title="Ver información de vacunación">
                                                        <i class="fas fa-syringe text-blue-500 text-lg"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('Ver historial')
                                                <td> <a wire:click="$dispatch('VerDetalleTratamientoFreacion',{animalId:{{ $animal->id }}, tipoTratamiento:'Desparacitacion'})"
                                                        class="tourHistorial-5 bg-slate-200 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-200"
                                                        title="Ver información de desparacitación">
                                                        <i class="fas fa-pills text-blue-500 text-lg"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('Ver historial')
                                                <td> <a wire:click="$dispatch('openModalHistorial',{animalId:{{ $animal->id }}, responsableId:{{ $animal->responsible_id }}})"
                                                        class="tourHistorial-2 bg-slate-200 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-200"
                                                        title="Ver información completa">
                                                        <i class="fas fa-file-medical text-blue-500 text-lg"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('Descargar historial')
                                                <td>
                                                    <a wire:click="$dispatch('generatePdf',{animalId:{{ $animal->id }}, responsableId:{{ $animal->responsible_id }}})"
                                                        class="tourHistorial-3 bg-slate-200 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-300"
                                                        title="Ver información completa">
                                                        <i class="fa-regular fa-file-pdf m-1 text-lg text-red-500"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        <td class="pt-5 text-center text-black dark:bg-darkmode-600 bg-transparent font-bold"
                                            colspan="100">No hay registros disponibles</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $this->animals->links() }}
    </div>
</div>

@push('modals')
    <livewire:historial.tratamiento />
@endpush
@push('modals')
    <livewire:historial.management />
@endpush
