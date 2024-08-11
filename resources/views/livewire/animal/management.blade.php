<div>
    <x-modal wire:model='animalModal' maxWidth="3xl" id="manage-animal-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                        {{ $animal->id ? 'Actualizar Animal' : 'Crear Animal' }}
                    </h3>
                    <button type="button" wire:click='closeModal'
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">

                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <div class="grid grid-cols-3 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model='animal.name' id="animal.name" label="Nombre" type="text"
                                required />
                            @error('animal.name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.form-label class="form-label text-left w-full">Responsable *
                            </x-custom.form-label>
                            <select wire:model="animal.responsible_id" id="animal.responsible_id"
                                class ="select2 transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 ">
                                <option value="" selected>Seleccione un responsable</option>
                                @foreach ($this->selectResponsable as $responsable)
                                    <option value="{{ $responsable->id }}">{{ $responsable->name }}</option>
                                @endforeach
                            </select>
                            @error('animal.responsible_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <x-custom.input wire:model='animal.microchip_code' id="animal.microchip_code"
                                label="Microchip" type="text" />
                            @error('animal.microchip_code')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 p-2">
                        <div>
                            <x-custom.form-label class="form-label text-left w-full">Especie *
                            </x-custom.form-label>
                            <select wire:model='animal.animal_species_id' id="animal.animal_species_id"
                                class ="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 ">
                                <option selected>Seleccione un especie</option>
                                @foreach ($this->selectEspecies as $especie)
                                    <option value="{{ $especie->id }}">{{ $especie->name }}</option>
                                @endforeach
                            </select>
                            @error('animal.animal_species_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='animal.animal_race' id="animal.animal_race" label="Raza"
                                type="text" />
                            @error('animal.animal_race')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='animal.blood_type' id="animal.blood_type" label="Tipo sangre"
                                type="text" />
                            @error('animal.blood_type')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model='animal.color' id="animal.color" label="Color" type="text" />
                            @error('animal.color')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='animal.weight' id="animal.weight" label="Peso"
                                type="text" />
                            @error('animal.weight')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.form-label class="form-label text-left w-full">Sexo
                            </x-custom.form-label>
                            <select wire:model="animal.sex" id="animal.sex"
                                class ="select2 transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 ">
                                <option value="" selected>Seleccione el sexo</option>
                                @foreach ($this->sexoAnimal as $sexo)
                                    <option value="{{ $sexo }}">{{ $sexo }}</option>
                                @endforeach
                            </select>
                            @error('animal.sex')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='animal.age' id="animal.age" label="Edad" type="text" />
                            @error('animal.age')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-3 p-2">
                        <div>
                            <input type="file" wire:model="image"
                                class=" items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer space-y-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

                            @if ($imagePreview)
                                <img src="{{ $imagePreview }}" alt="Image Preview"
                                    class="mt-4 rounded shadow max-w-xs w-64 h-48">
                            @endif

                            @error('animal.foto')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <x-custom.modal.footer>
                <div class="text-right">
                    {{--                     <x-custom.button class="bg-slate-400 hover:bg-red-500" type="button" wire:click="closeModal">
                        Cancelar
                    </x-custom.button> --}}
                    <x-custom.button class="bg-green-300 hover:bg-green-500 " type="submit">
                        {{ $animal->id ? 'Actualizar' : 'Guardar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            alert('holis');
            $('#select2').select2();

            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('selectedOption', data);
            });
        });
    </script>
@endpush
