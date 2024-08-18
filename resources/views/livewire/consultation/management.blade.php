<div>
    <x-modal wire:model='consultaModal' maxWidth="3xl" id="manage-consulta-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                        {{ $consultations->id ? 'Actualizar consulta' : 'Registrar consulta' }}

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
                        @if ($this->boolOcultar)
                            <div>
                                <x-custom.form-label class="form-label text-left w-full">Doctor *
                                </x-custom.form-label>
                                <select wire:model="consultations.doctor_id" id="consultations.doctor_id"
                                    class ="select2 transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 ">
                                    <option value="" selected>Seleccione un doctor</option>
                                    @foreach ($this->doctores as $doctore)
                                        <option value="{{ $doctore->id }}">{{ $doctore->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-custom.input wire:model='consultations.date_time_query'
                                    id="consultations.date_time_query" label="Fecha consulta" type="datetime-local"
                                    min="{{ now()->format('Y-m-d\TH:i') }}"
                                    required />
                            </div>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 gap-3 p-2">
                        <div wire:ignore>
                            <label class="mt-2 mb-1">Motivo de la consulta</label>
                            <textarea wire:model="consultations.reason"
                                class="
                                transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                  disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                  readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                  group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                  group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                id="consultations.reason" cols="100" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="grid grid-cols-1 gap-3 p-2">
                        <div>
                            <label class="mt-2 mb-1">Observaciones</label>
                            <textarea wire:model="consultations.note"
                                class="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                  disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                  readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                  group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                  group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                id="consultations.note" cols="100" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <x-custom.modal.footer>
                <div class="text-right">
                    <x-custom.button class="bg-green-300 hover:bg-green-500 " type="submit">
                        {{ $consultations->id ? 'Actualizar' : 'Guardar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>