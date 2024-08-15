<div>
    <x-modal wire:model='indexModal' maxWidth="4xl" id="manage-index-tratamiento-modal">
        <div class="mx-2">
            <div class="mb-2 w-full">
                <div class="mt-5 grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                        <div class="flex justify-between items-center py-3 px-4 border-b">
                            <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                                Listado tratamiento
                            </h3>
                            <button type="button" wire:click='closeModal'
                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">

                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-between items-center py-3 px-4 border-b">
                            <div class="relative w-56 text-slate-500">
                                <x-input id="search" titleInput="búscar " wire:model.live="search"
                                    class="!box w-56 pr-10 tooltip" type="search" placeholder="Búscar..." />
                            </div>
                            <div>
                                <x-custom.button wire:click="$dispatch('openTratamientoModal')"
                                    title="Crear una consulta" class="bg-blue-400 hover:bg-blue-500">
                                    Nuevo tratamiento
                                </x-custom.button>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="flex-auto block p-3">
                                <div class="overflow-x-auto">
                                    <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                        <thead class="align-bottom">
                                            <tr class="font-semibold text-secondary-dark border p-3">
                                                <th class="p-3 text-left">Medicamtento</th>
                                                <th class="p-3 text-left">Presentación</th>
                                                <th class="p-3 text-center">Aplicación</th>
                                                <th class="p-3 text-center">Refuerzo</th>
                                                <th class="p-3 text-center">Dosis</th>
                                                <th class="p-3 text-center">Frecuencia</th>
                                                <th class="p-3 text-center">Interna o externa</th>
                                                <th class="p-3 text-center">Duración</th>
                                                <th class="p-3 text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($this->Treatment as $tratamiento)
                                                <tr
                                                    class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                                    <td class="p-3 text-left">{{ $tratamiento->drug_name }}</td>
                                                    <td class="p-3 text-left"> {{ $tratamiento->medicine_presentation }}
                                                    </td>
                                                    <td class="p-3 text-center">
                                                        {{ $tratamiento->application_date }}</td>
                                                    <td class="p-3">{{ $tratamiento->reinforcement_date }} </td>
                                                    <td class="p-3">{{ $tratamiento->dose }} </td>
                                                    <td class="p-3">{{ $tratamiento->frequency }} </td>
                                                    <td class="p-3">
                                                        {{ $tratamiento->internal_or_external ? 'Interno' : 'Externo' }}
                                                    </td>
                                                    <td class="p-3">{{ $tratamiento->treatment_duration }} </td>

                                                    <td class="p-3">
                                                        <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                            title="Ver consulta completa">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:cale-110"
                                                            title="Editar consulta">
                                                            <i class="fas fa-edit"></i></a>
                                                        <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                            title="Eliminar consulta">
                                                            <i class="fas solid fa-trash-can"></i>
                                                        </a>
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
            </div>
        </div>
    </x-modal>
</div>
@push('modals')
    <livewire:treatment.management />
@endpush
