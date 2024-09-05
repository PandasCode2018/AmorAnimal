<div>
    <x-modal wire:model='triageModal' maxWidth="4xl" id="manage-triage-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="flex justify-end items-center py-3 px-4 border-b">
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
                <div class="">
                    <fieldset class="border p-4 rounded-md">
                        <legend class="text-lg font-bold">Examen físico general</legend>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3 p-2">
                            <div>
                                <x-custom.input-select id="triage.condicion_corporal" name="triage.condicion_corporal"
                                    class="tooltip"
                                    title="Evaluación subjetiva del estado nutricional del animal, generalmente en una escala 1 al 5, donde 1 indica extrema delgadez y 9 obesidad. Se evalúa palpando áreas clave del cuerpo"
                                    wire:model="triage.condicion_corporal" label="Condición corporal">
                                    <option value="" selected>Seleccione una opción</option>
                                    @foreach ($this->condicionCorporal as $condicion)
                                        <option value="{{ $condicion }}">{{ $condicion }}</option>
                                    @endforeach
                                </x-custom.input-select>
                            </div>
                            <div>
                                <x-custom.input id="triage.temperatura_corporal" name="triage.temperatura_corporal"
                                    label="Temperatura corporal" wire:model="triage.temperatura_corporal"
                                    class="tooltip"
                                    title="Medida de la temperatura rectal del animal, que indica si tiene fiebre o hipotermia. Varía según la especie."
                                    type="text" placeholder="38.5" />
                            </div>
                            <div>
                                <x-custom.input id="triage.frecuencia_respiratoria"
                                    name="triage.frecuencia_respiratoria" label="Frecuencia respiratoria"
                                    wire:model="triage.frecuencia_respiratoria" class="tooltip"
                                    title="Número de respiraciones por minuto. Se evalúa observando el movimiento del tórax."
                                    type="text" placeholder="20" />
                            </div>
                            <div>
                                <x-custom.input id="triage.relleno_capilar" name="triage.relleno_capilar"
                                    label="Tiempo de relleno capilar" wire:model="triage.relleno_capilar"
                                    class="tooltip"
                                    title="Tiempo que tarda el color rosado en volver a las encías después de presionarlas, utilizado para evaluar la perfusión sanguínea y la función cardiovascular"
                                    type="text" placeholder="<2  5>" />
                            </div>
                            <div>
                                <x-custom.input-select id="triage.mucosa" name="triage.mucosa"
                                    wire:model="triage.mucosa" label="Mucosa" class="tooltip"
                                    title="Aspecto de las membranas mucosas, como las encías. Se evalúa el color y la humedad, lo que puede indicar la oxigenación y la hidratación del animal.">
                                    <option value="" selected>Seleccione una opción</option>
                                    @foreach ($this->mucosa as $mucos)
                                        <option value="{{ $mucos }}">{{ $mucos }}</option>
                                    @endforeach
                                </x-custom.input-select>
                            </div>
                            <div>
                                <x-custom.input id="triage.frecuencia_cardiaca" name="triage.frecuencia_cardiaca"
                                    label="Frecuencia cardíaca" type="text" wire:model="triage.frecuencia_cardiaca"
                                    class="tooltip"
                                    title="Número de latidos cardíacos por minuto. Varía según la especie, tamaño y estado de salud del animal."
                                    placeholder="80" />
                            </div>
                            <div>
                                <x-custom.input id="triage.llenado_capilar" name="triage.llenado_capilar"
                                    label="Tiempo de llenado capilar" wire:model="triage.llenado_capilar"
                                    class="tooltip"
                                    title="Similar al TRC (Tiempo de Relleno Capilar). Evalúa la circulación sanguínea al presionar las encías y observar cuánto tiempo tarda en volver el color rosado."
                                    type="text" placeholder="2" />
                            </div>
                            <div>
                                <x-custom.input-select id="triage.pulso" name="triage.pulso" label="Pulso"
                                    wire:model="triage.pulso" class="tooltip"
                                    title="Evaluación de la calidad del pulso, que incluye la fuerza, regularidad y ritmo. Se suele palpar en la arteria femoral en animales.">
                                    <option value="" selected>Seleccione una opción</option>
                                    @foreach ($this->pulsos as $pulso)
                                        <option value="{{ $pulso }}">{{ $pulso }}</option>
                                    @endforeach
                                </x-custom.input-select>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset class="border p-4 rounded-md">
                        <legend class="text-lg font-bold">Anamenesis</legend>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 p-2">
                            <div>
                                <x-custom.input id="triage.numero_pardos" name="triage.numero_pardos"
                                    label="Numero de partos" wire:model="triage.numero_pardos" class="tooltip"
                                    title="Medida de la temperatura rectal del animal, que indica si tiene fiebre o hipotermia. Varía según la especie."
                                    type="number" placeholder="" />
                            </div>
                            <div>
                                <x-custom.input-select id="triage.esterelizado" name="triage.esterelizado"
                                    wire:model="triage.esterelizado" label="Esterilizado">
                                    <option value="" selected>Seleccione una opción</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </x-custom.input-select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 p-2">
                            <div>
                                <label class="mt-2 mb-1">Ultima desparacitación y producto</label>
                                <textarea wire:model="triage.ultima_desparacitacion"
                                    class="bg-[#f3faf8]
                                    transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                    focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                     dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                      disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                      readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                      group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                      group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                    id="triage.ultima_desparacitacion" cols="100" rows="4"></textarea>
                            </div>
                            <div>
                                <label class="mt-2 mb-1">Cirugías previas</label>
                                <textarea wire:model="triage.cirugias_previas"
                                    class="bg-[#f3faf8]
                                    transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                    focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                     dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                      disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                      readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                      group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                      group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                    id="triage.cirugias_previas" cols="100" rows="4"></textarea>
                            </div>
                            <div>
                                <label class="mt-2 mb-1">Esquema vacunal</label>
                                <textarea wire:model="triage.esquema_vacunal"
                                    class="bg-[#f3faf8]
                                    transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                    focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                     dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                      disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                      readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                      group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                      group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                    id="triage.esquema_vacunal" cols="100" rows="4"></textarea>
                            </div>
                            <div>
                                <label class="mt-2 mb-1">Tratamiento recientes</label>
                                <textarea wire:model="triage.tratamiento_reciente"
                                    class="bg-[#f3faf8]
                                    transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                    focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                     dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                      disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                      readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                      group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                      group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                    id="triage.tratamiento_reciente" cols="100" rows="4"></textarea>
                            </div>
                            <div>
                                <label class="mt-2 mb-1">Enfermedades previas</label>
                                <textarea wire:model="triage.enfermedades_previas"
                                    class="bg-[#f3faf8]
                                    transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                    focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                     dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                      disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                      readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                      group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                      group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                    id="triage.enfermedades_previas" cols="100" rows="4"></textarea>
                            </div>
                            <div>
                                <label class="mt-2 mb-1">Dieta</label>
                                <textarea wire:model="triage.dieta"
                                    class="bg-[#f3faf8]
                                    transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                    focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                     dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                      disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                      readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                      group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                      group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                    id="triage.dieta" cols="100" rows="4"></textarea>
                            </div>
                        </div>

                    </fieldset>
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
                        Guardar
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>
