<div>
    <x-modal wire:model='tratamientoModal' maxWidth="3xl" id="manage-tratamiento-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                        Agregar tratamiento
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
                    <div class="grid grid-cols-2 gap-3 pt-3 p-2">
                        <div>
                            <x-custom.input wire:model="treatment.drug_name" id="treatment.drug_name"
                                label="Medicamento" type="text" required />
                        </div>
                        <div>
                            <x-custom.form-label class="form-label text-left w-full">Presentación *
                            </x-custom.form-label>
                            <select wire:model="treatment.medicine_presentation" id="treatment.medicine_presentation"
                                class ="select2 transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 ">
                                <option value="" selected>Seleccione un opción</option>
                                @foreach ($this->presentaciones as $presentacion)
                                    <option value="{{ $presentacion }}">{{ $presentacion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 pt-3 p-2">
                        <div>
                            <x-custom.input wire:model='treatment.dose' id="treatment.dose" label="Dosis"
                                placeholder="1 tableta" type="text" required />
                        </div>
                        <div>
                            <x-custom.input wire:model='treatment.frequency' id="treatment.frequency" label="Frecuencia"
                                placeholder="cada 24 horas" type="text" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-3 p-2">
                        <div>
                            <x-custom.form-label class="form-label text-left w-full">Interno o externa
                            </x-custom.form-label>
                            <select wire:model="treatment.internal_or_external" id="treatment.internal_or_external"
                                class ="select2 transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 ">
                                <option value="" selected>Seleccione un opción</option>
                                @foreach ($this->internaOexterna as $index => $tipo)
                                    <option value="{{ $index }}">{{ $tipo }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div>
                            <x-custom.input wire:model='treatment.treatment_duration' id="treatment.treatment_duration"
                                label="Duracion del tratamiento" type="text" placeholder="1 semana" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-3 p-2">
                        <div>
                            <x-custom.input wire:model='treatment.application_date' id="treatment.application_date"
                                label="Fecha de aplicación" type="date" min="{{ date('Y-m-d') }}" required />
                        </div>
                        <div>
                            <x-custom.input wire:model='treatment.reinforcement_date' id="treatment.reinforcement_date"
                                label="Fecha de refuerzo" type="date" min="{{ date('Y-m-d') }}" />
                        </div>
                    </div>

                    <div class="grip gap-3 grip-cols-3 p-t3 p-2">
                        <div>
                            <label class="mt-2 mb-1">Observaciones</label>
                            <textarea wire:model="treatment.note"
                                class="
                                transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                  disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                  readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                  group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                  group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                id="treatment.note" cols="100" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <ul>
                                    <alert class="text-red-500">{{ $error }}</alert>
                                </ul>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <x-custom.modal.footer>
                <div class="text-right">
                    <x-custom.button class="bg-green-300 hover:bg-green-500 " type="submit">
                        Guardar
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>
