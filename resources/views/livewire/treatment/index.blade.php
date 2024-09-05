<div>
    <x-modal wire:model='indexModal' maxWidth="3xx" id="manage-index-tratamiento-modal">
        <div class="mx-2 bg-[#f3faf8] tourTratamiento-0">
            <div class="mb-2 w-full">
                <div class="mt-5 grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                        <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-between">
                            <button wire:click="$dispatch('tutorialTratamiento')"
                                class="flex items-center px-2 py-1 m-1 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                                <i class="fas fa-question-circle"></i>
                                Tutorial
                            </button>
                            <button type="button" wire:click='closeModal'
                                class="p-3 m-3 size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100
                                 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 
                                 disabled:pointer-events-none dark:text-neutral-400">

                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-center items-center py-3 px-4 border-b">
                            <div class="intro-y flex justify-center items-center rounded-lg">
                                <h2
                                    class="font-serif font-semibold text-center text-lg text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                                    Listado de seguimientos
                                </h2>
                            </div>
                        </div>
                        <div
                            class="intro-y col-span-12 mt-2 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400">

                            <div class="p-2 w-full sm:w-auto">
                                @can('Crear treatments')
                                    <x-custom.button wire:click="$dispatch('openTratamientoModal')"
                                        title="Crear un nuevo usuario"
                                        class="tourTratamiento-1 w-full sm:w-auto bg-[#7a7cbf] hover:bg-[#6c6ea7] text-white py-2 px-4 text-base sm:text-sm font-medium">
                                        Nuevo tratamiento
                                    </x-custom.button>
                                @endcan
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="flex-auto block p-3">
                                <div class="overflow-x-auto max-h-96 ">
                                    <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                        <thead class="align-bottom">
                                            <tr class="font-semibold text-secondary-dark border p-3">
                                                <th class="p-3 text-left">Medicamtento</th>
                                                <th class="p-3 text-left">Presentación</th>
                                                <th class="p-3 text-center">Aplicación</th>
                                                <th class="p-3 text-center">Refuerzo</th>
                                                <th class="p-3 text-center">Dosis</th>
                                                <th class="p-3 text-center">Aplicada</th>
                                                <th class="p-3 text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($this->consultaId)
                                                @forelse ($this->treatment as $tratamiento)
                                                    <tr
                                                        class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all
                                                         duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                                        <td class="p-3 text-left">{{ $tratamiento->drug_name }}</td>
                                                        <td class="p-3 text-left">
                                                            {{ $tratamiento->medicine_presentation }}
                                                        </td>
                                                        <td class="p-3 text-center">
                                                            {{ $tratamiento->application_date }}</td>
                                                        <td class="p-3">
                                                            {{ $tratamiento->reinforcement_date ?? 'No aplica' }} </td>
                                                        <td class="p-3">{{ $tratamiento->dose }} </td>
                                                        <td class="p-3">
                                                            @if (!$tratamiento->aplicado)
                                                                <a wire:click="$dispatch('aplicarTratamiento', {tratamientoUuid: '{{ $tratamiento->uuid }}', aplicada: false})"
                                                                    title="Marcar como aplicado"
                                                                    class="bg-slate-400  text-white cursor-pointer rounded p-1 mx-1  hover:bg-green-500">
                                                                    <i class="fa-regular fa-square-check text-lg"></i>
                                                                </a>
                                                            @else
                                                                <p class="text-green-500 font-semibold">Aplicada</p>
                                                            @endif
                                                        </td>


                                                        <td class="p-3">
                                                            <a wire:click="$dispatch('detalleTratamientoModal', {tratamientoUuid: '{{ $tratamiento->uuid }}'})"
                                                                class="tourTratamiento-2 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                                title="Ver consulta completa">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            @if (!$tratamiento->aplicado)
                                                                @can('Editar treatments')
                                                                    <a wire:click="$dispatch('openTratamientoModal', {tratamientoUuid: '{{ $tratamiento->uuid }}'})"
                                                                        class="tourTratamiento-3 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:scale-110"
                                                                        title="Editar tratamientos">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('Eliminar treatments')
                                                                    <a class="tourTratamiento-4 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                                        title="Eliminar tratamiento"
                                                                        wire:click="delete('treatments', '{{ $tratamiento->uuid }}')"
                                                                        wire:confirm.prompt="{{ $this->confirmQuestion }}">
                                                                        <i class="fas fa-trash-can"></i>
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
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>
</div>
@push('modals')
    <livewire:treatment.management />
@endpush
@push('modals')
    <livewire:treatment.detalle />
@endpush
