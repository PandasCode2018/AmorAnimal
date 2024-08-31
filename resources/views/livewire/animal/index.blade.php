@section('subhead')
    <title>Animales - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2 bg-[#f3faf8] tourAnimales-0">
    <div class="mb-2 w-full">
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 flex flex-col-reverse lg:col-span-3 lg:block 2xl:col-span-3 shadow-2xl ">
                <div class="intro-y box mt-6 p-5">
                    <div class="p-2 w-full sm:w-auto">
                        @can('Crear animal_species')
                            <x-custom.button wire:click="$dispatch('openEspecieModal')" title="Agregar nuevo registro"
                                class="tourAnimales-8 w-full sm:w-auto bg-[#7a7cbf] hover:bg-[#6c6ea7] text-white py-2 px-4 text-base sm:text-sm font-medium">
                                Nuevo especie
                            </x-custom.button>
                        @endcan
                    </div>
                    <div class="overflow-x-auto lg:overflow-visible">
                        <table class="w-full my-0 align-middle text-dark border-neutral-200">
                            <tbody>
                                @forelse ($this->animalEspecies  as $especie)
                                    <tr
                                        class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                        <td class="p-3 text-left">
                                            <div class="mr-3 h-2 w-2 rounded-full bg-secondary"></div>
                                            {{ $especie->name }}
                                        </td>
                                        @can('Editar animal_species')
                                            <td class="tourAnimales-9 text-gray-500 hover:text-yellow-500 tooltip" title="Editar"
                                                wire:click="$dispatch('openEspecieModal', {especieUuId: '{{ $especie->uuid }}' })">
                                                <i class="fas fa-edit"></i>
                                            </td>
                                        @endcan
                                        @can('Eliminar animal_species')
                                            <td class="tourAnimales-10 text-gray-500 hover:text-red-500 tooltip" title="Eliminar"
                                                wire:click="delete('animalEspecies','{{ $especie->uuid }}')"
                                                wire:confirm.prompt="{{ $this->confirmQuestion }}">
                                                <i class="fas solid fa-trash-can"></i>
                                            </td>
                                        @endcan
                                    </tr>
                                    <hr>
                                @empty
                                    No hay registros disponibles
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-span-12 lg:col-span-9 2xl:col-span-9 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialAnimales')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y flex justify-center items-center shadow-sm rounded-lg">
                    <h2
                        class="font-serif font-semibold text-center text-3xl text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                        Listado de animales
                    </h2>
                </div>

                <div
                    class="intro-y col-span-12 mt-2 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400">

                    <div class="tourAnimales-2 relative w-full sm:w-56 text-slate-500 mb-4 sm:mb-0">
                        <x-input id="search" titleInput="Filtro para buscar usuarios" wire:model.live="search"
                            class="!box w-full sm:w-56 pr-10 tooltip" type="search" placeholder="Buscar..." />
                    </div>

                    <div class="p-2 w-full sm:w-auto">
                        @can('Crear animals')
                            <x-custom.button wire:click="$dispatch('openAnimalModal')" title="Crear un nuevo usuario"
                                class="tourAnimales-3 w-full sm:w-auto bg-[#7a7cbf] hover:bg-[#6c6ea7] text-white py-2 px-4 text-base sm:text-sm font-medium">
                                Nuevo Animal
                            </x-custom.button>
                        @endcan
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Foto</th>
                                        <th class="p-3 text-left">identificacion</th>
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-center">Especie</th>
                                        <th class="p-3 text-center">Responsable</th>
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->animals as $animal)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 text-left"> <img
                                                    src="{{ $animal->photo ? Storage::url($animal->photo) : asset('img_sistema/animal.jpg') }}"
                                                    alt="Foto del animal"
                                                    class="w-12 h-12 object-cover rounded-full shadow-lg"></td>

                                            <td class="p-3 text-left">{{ $animal->code_animal }}</td>
                                            <td class="p-3  text-left"> {{ $animal->name }}</td>
                                            <td class="p-3 text-center"> {{ $animal->animalSpecies->name }}</td>
                                            <td class="p-3 text-center"> {{ $animal->responsible->name }}</td>

                                            <td class="p-3">
                                                <a wire:click="$dispatch('opeModalDetalleAnimal', {animalUuid:'{{ $animal->uuid }}'})"
                                                    class="tourAnimales-4 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                    title="Ver información completa">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @can('Crear consultations')
                                                    <a wire:click="$dispatch('openConsultaModal',{animalId:'{{ $animal->id }}'})"
                                                        class="tourAnimales-5 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                        title="Agregar Consulta">
                                                        <i class="fa-solid fa-stethoscope"></i>
                                                    </a>
                                                @endcan
                                                @can('Editar animals')
                                                    <a class="tourAnimales-6 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:cale-110"
                                                        wire:click="$dispatch('openAnimalModal', {animalUuid:'{{ $animal->uuid }}'})"
                                                        title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('Eliminar animals')
                                                    <a class="tourAnimales-7 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                        wire:click="delete('animals','{{ $animal->uuid }}')"
                                                        wire:confirm.prompt="{{ $this->confirmQuestion }}"
                                                        title="Eliminar">
                                                        <i class="fas solid fa-trash-can"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="pt-5 text-center text-black dark:bg-darkmode-600 bg-transparent font-bold"
                                            colspan="100">No
                                            hay registros disponibles</td>
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
    <livewire:animal.management />
@endpush

@push('modals')
    <livewire:consultation.management />
@endpush

@push('modals')
    <livewire:animal-specie.management />
@endpush

@push('modals')
    <livewire:animal.detalle />
@endpush
