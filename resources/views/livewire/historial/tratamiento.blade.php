<div>
    <x-modal wire:model='modalTratamientoFreacion' maxWidth="3xl" id="manage-tratamientoFreacion-modal">

        {{--  vacunacion --}}
        @if ($this->tipoTratamiento == 'Vacunacion')

            <div class="p-5 bg-gray-100 max-h-[900px] overflow-y-auto">
                <div
                    class="flex justify-between items-center py-3 px-4 border-b bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-t-lg shadow-md">
                    <h3 class="text-3xl font-bold">Carnet de Vacunación</h3>
                    <button type="button" wire:click='closeModal'
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6L6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Información del Animal -->
                @if (!is_null($this->informacionAnimal))
                    @foreach ($this->informacionAnimal as $animal)
                        <div
                            class="bg-white rounded-lg shadow-lg p-6 mb-6 flex flex-col md:flex-row items-start space-y-4 md:space-y-0 md:space-x-6">
                            <!-- Imagen del Animal -->
                            <div class="w-32 h-32 border-2 border-indigo-500 rounded-lg overflow-hidden mb-4 md:mb-0">
                                <img src="{{ $animal->photes->isNotEmpty() ? Storage::url($animal->photes->first()->photeAnimal) : asset('img_sistema/animal.jpg') }}"
                                    alt="Foto del Animal" class="w-full h-full object-cover">
                            </div>

                            <!-- Información del Animal -->
                            <div class="flex-1">
                                <h2 class="text-2xl font-semibold mb-2 text-gray-800">{{ $animal->name }}</h2>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="font-semibold text-gray-600">Especie:</label>
                                        <p class="text-gray-700">{{ $animal->animalSpecies->name }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-gray-600">Raza:</label>
                                        <p class="text-gray-700">{{ $animal->animal_race }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-gray-600">Edad:</label>
                                        <p class="text-gray-700">{{ $animal->age }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-gray-600">Color:</label>
                                        <p class="text-gray-700">{{ $animal->color }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Tratamientos (Vacunación) -->
                @if ($this->infomacionTrataminto)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-4 text-indigo-600">Historial de Vacunación</h2>
                    <hr class="mb-4 border-t border-gray-300">
                    <div class="overflow-x-auto">
                        @foreach ($this->infomacionTrataminto->groupBy('consultation.reason') as $reason => $tratamientos)
                            <h3 class="text-lg font-semibold mb-4">{{ $reason }}</h3> <!-- Título con la razón de la consulta -->
                
                            <table class="min-w-full divide-y divide-gray-200 mb-6"> <!-- Tabla para los tratamientos -->
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tratamiento
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Medicamento
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha aplicación
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha refuerzo
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tratamientos as $tratamiento)
                                        <tr>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $tratamiento->consultation->name }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $tratamiento->drug_name }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $tratamiento->application_date }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $tratamiento->reinforcement_date ?? 'Sin fecha' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
                
                @else
                    <p class="text-center text-gray-700">No hay historial de vacunación o desparacitación disponible.
                    </p>
                @endif
            </div>

        @endif
        {{--    desparacitacion --}}
        @if ($this->tipoTratamiento == 'Desparacitacion')
            <div class="p-5 bg-gray-100 max-h-[900px] overflow-y-auto">
                <div
                    class="flex justify-between items-center py-3 px-4 border-b bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-t-lg shadow-md">
                    <h3 class="text-3xl font-bold">Carnet de desparacitación</h3>
                    <button type="button" wire:click='closeModal'
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6L6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Información del Animal -->
                @if (!is_null($this->informacionAnimal))
                    @foreach ($this->informacionAnimal as $animal)
                        <div
                            class="bg-white rounded-lg shadow-lg p-6 mb-6 flex flex-col md:flex-row items-start space-y-4 md:space-y-0 md:space-x-6">
                            <!-- Imagen del Animal -->
                            <div class="w-32 h-32 border-2 border-indigo-500 rounded-lg overflow-hidden mb-4 md:mb-0">
                                <img src="{{ $animal->photes->isNotEmpty() ? Storage::url($animal->photes->first()->photeAnimal) : asset('img_sistema/animal.jpg') }}"
                                    alt="Foto del Animal" class="w-full h-full object-cover">
                            </div>

                            <!-- Información del Animal -->
                            <div class="flex-1">
                                <h2 class="text-2xl font-semibold mb-2 text-gray-800">{{ $animal->name }}</h2>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="font-semibold text-gray-600">Especie:</label>
                                        <p class="text-gray-700">{{ $animal->animalSpecies->name }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-gray-600">Raza:</label>
                                        <p class="text-gray-700">{{ $animal->animal_race }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-gray-600">Edad:</label>
                                        <p class="text-gray-700">{{ $animal->age }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold text-gray-600">Color:</label>
                                        <p class="text-gray-700">{{ $animal->color }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Tratamientos (Vacunación) -->
                @if ($this->infomacionTrataminto)
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-indigo-600">Historial de Desparcitación</h2>
                        <hr class="mb-4 border-t border-gray-300">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tratamiento</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Medicamento</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha aplicación</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha refuerzo</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($this->infomacionTrataminto as $tratamiento)
                                        <tr>
                                            <td class="px-4 py-4 whitespace-nowrap">{{ $tratamiento->name }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap">{{ $tratamiento->drug_name }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $tratamiento->application_date }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                {{ $tratamiento->reinforcement_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-700">No hay historial de vacunación o desparacitación disponible.
                    </p>
                @endif
            </div>

        @endif

    </x-modal>
</div>
