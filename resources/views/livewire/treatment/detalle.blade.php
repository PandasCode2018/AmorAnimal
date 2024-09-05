<div>
    <x-modal wire:model='detalleModalTratamiento' maxWidth="3xl" id="manage-detalleTratamiento-modal">
        <div class="flex justify-between items-center py-3 px-4 border-b">

            <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">Tratamiento</h3>
            <button type="button" wire:click='closeModal'
                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300
                 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
        <section class="w-full max-h-[90vh] overflow-auto">
            <div class="flex flex-col">
                <img src="{{ asset('img_sistema/tratamiento.jpg') }}" alt="User Cover"
                    class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem]" />
                <dl class="col-span-12 lg:col-span-9 grid grid-cols-1 md:grid-cols-3 gap-4 p-4 m-4 text-gray-900  ">
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Medicamento</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->drug_name ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Presentación</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->medicine_presentation ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Fecha de aplicación</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->application_date ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Fecha de refuerzo</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->reinforcement_date ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dosis</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->dose ?? '' }} Kilos</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Frecuencia</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->frequency ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Externa o interna</dt>
                        <dd class="text-lg font-semibold">
                            {{ $treatment->internal_or_external ?? 'N/A' == 1 ? 'Interna' : 'Externa' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dureación</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->treatment_duration ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tipo tratamiento</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->tipo_tratamiento ?? '' }}</dd>
                    </div>
                </dl>
                <div class="col-span-12 lg:col-span-12 grid grid-cols-1 md:grid-cols-1 gap-1 p-3 m-2 text-gray-900 ">
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Notas</dt>
                        <dd class="text-lg font-semibold">{{ $treatment->note ?? '' }}</dd>
                    </div>
                </div>
            </div>
        </section>
    </x-modal>
</div>
