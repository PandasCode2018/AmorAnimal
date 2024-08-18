<div>
    <x-modal wire:model='historialModal' maxWidth="3xl" id="manage-historial-modal">
        <div class="p-5 bg-gray-100 max-h-[900px]  overflow-y-auto">
            <div class="flex justify-between items-center py-3 px-4 border-b">
                <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                    Historial
                </h3>
                <button type="button" wire:click='closeModal'
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">

                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Animal Information -->
            @if (!is_null($this->informacionAnimal))
                @forelse ($this->informacionAnimal as $animal)
                    <div class="bg-white rounded shadow p-6 mb-6">
                        <span>Animal</span>
                        <h2 class="text-2xl font-semibold mb-4">{{ $animal->name }}</h2>
                        <hr class="mt-2 mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {{--  <div>
                                <img src="{{ Storage::url($animal->photo) }}" alt="" class="h-20 w-20">
                            </div> --}}
                            <div>
                                <label class="font-semibold">Especie:</label>
                                <p class="text-gray-700">{{ $animal->animalSpecies->name }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Raza:</label>
                                <p class="text-gray-700">{{ $animal->animal_race }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Edad:</label>
                                <p class="text-gray-700">{{ $animal->age }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Color:</label>
                                <p class="text-gray-700">{{ $animal->color }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Peso:</label>
                                <p class="text-gray-700">{{ $animal->weight }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Sexo:</label>
                                <p class="text-gray-700">{{ $animal->sex }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Error consulta la informacion del animal</p>
                @endforelse
            @endif

            <!-- Owner Information -->
            @if ($this->infomacionResponsable)
                @forelse ($this->infomacionResponsable as $responsable)
                    <div class="bg-white rounded shadow p-6 mb-6">
                        <span>Responsable</span>
                        <h2 class="text-2xl font-semibold mb-4">{{ $responsable->name }}</h2>
                        <hr class="mt-2 mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold">Docuemnto:</label>
                                <p class="text-gray-700">{{ $responsable->document_number }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Teléfono:</label>
                                <p class="text-gray-700">{{ $responsable->phone }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Correo:</label>
                                <p class="text-gray-700">{{ $responsable->email }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Dirección:</label>
                                <p class="text-gray-700">{{ $responsable->address }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Error consulta la informacion del responsable</p>
                @endforelse
            @endif

            <!-- Medical Consultations -->
            @if ($this->informacionConsultas)
                <div class="bg-white rounded shadow p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-4">Consultas Médicas</h2>
                    <hr class="mt-2 mb-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Doctor
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Motivo
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($this->informacionConsultas as $consulta)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->date_time_query }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->reason }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $consulta->queryStatus->name_status }}
                                    </td>
                                </tr>

                                <!-- Mostrar Notas de ingreso una sola vez -->
                                <tr>
                                    <td colspan="4" class="px-6 py-4 bg-gray-50">
                                        <div class="col-span-2">
                                            <label class="font-semibold">Notas de ingreso:</label>
                                            <p class="text-gray-700">{{ $consulta->note }}</p>
                                        </div>
                                    </td>

                                    <!-- Tratamientos de la consulta -->
                                    @foreach ($consulta->treatments as $tratamiento)
                                <tr>
                                    <td colspan="4" class="px-6 py-4 bg-gray-50">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="font-semibold">Nombre del Medicamento:</label>
                                                <p class="text-gray-700">{{ $tratamiento->drug_name }}</p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Presentación:</label>
                                                <p class="text-gray-700">{{ $tratamiento->medicine_presentation }}
                                                </p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Fecha de Aplicación:</label>
                                                <p class="text-gray-700">{{ $tratamiento->application_date }}</p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Fecha de Refuerzo:</label>
                                                <p class="text-gray-700">{{ $tratamiento->reinforcement_date }}</p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Dosis:</label>
                                                <p class="text-gray-700">{{ $tratamiento->dose }}</p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Frecuencia:</label>
                                                <p class="text-gray-700">{{ $tratamiento->frequency }}</p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Interno o Externo:</label>
                                                <p class="text-gray-700">
                                                    {{ $tratamiento->internal_or_external == 1 ? 'Interno' : 'Externo' }}
                                                </p>
                                            </div>
                                            <div>
                                                <label class="font-semibold">Duración del Tratamiento:</label>
                                                <p class="text-gray-700">{{ $tratamiento->treatment_duration }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <label class="font-semibold">Notas del tratamiento:</label>
                                                <p class="text-gray-700">{{ $tratamiento->note }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
            @endforeach
            </tbody>
            </table>
        </div>
    @else
        <p>No hay consultas médicas disponibles.</p>
        @endif

</div>
</x-modal>
</div>
