<div>
    <x-modal wire:model='detalleModalAnimal' maxWidth="3xl" id="manage-detalleAnimal-modal">
        <div class="flex justify-between items-center py-3 px-4 border-b">

            <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">Detalle de {{ $animal->name ?? '' }}</h3>
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

        <section class="w-full overflow-hidden dark:bg-gray-900">
            <div class="flex flex-col">
                <img src="{{ asset('img_sistema/banner.jpg') }}" alt="User Cover"
                    class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem]" />

                <div class="sm:w-[80%] xs:w-[90%] mx-auto flex">
                    <img src="{{ $animal->photo ?? '' ? Storage::url($animal->photo) : asset('img_sistema/animal.jpg') }}"
                        alt="User Profile"
                        class="rounded-md lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] outline outline-2 
                        outline-offset-2 outline-blue-500 relative lg:bottom-[5rem] sm:bottom-[4rem] xs:bottom-[3rem]" />

                    <h1
                        class="w-full text-left my-4 sm:mx-4 xs:pl-4 text-gray-800 dark:text-white sm:text-3xl xs:text-xl">
                        Codigo: {{ $animal->code_animal ?? '' }}
                    </h1>

                </div>
                <dl
                    class="col-span-12 lg:col-span-9 grid grid-cols-1 md:grid-cols-3 gap-4 p-4 m-4 text-gray-900  dark:text-white ">
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Responsable</dt>
                        <dd class="text-lg font-semibold">{{ $animal->responsible->name ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Color</dt>
                        <dd class="text-lg font-semibold">{{ $animal->color ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Especie</dt>
                        <dd class="text-lg font-semibold">{{ $animal->$animal->animalSpecies->name ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Raza</dt>
                        <dd class="text-lg font-semibold">{{ $animal->animal_race ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Peso</dt>
                        <dd class="text-lg font-semibold">{{ $animal->weight ?? '' }} Kilos</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Sexo</dt>
                        <dd class="text-lg font-semibold">{{ $animal->sex ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Edad</dt>
                        <dd class="text-lg font-semibold">{{ $animal->age ?? '' }} Años</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tipo de sangre</dt>
                        <dd class="text-lg font-semibold">{{ $animal->blood_type ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Microchip</dt>
                        <dd class="text-lg font-semibold">{{ $animal->Microchip ?? '' }}</dd>
                    </div>
                </dl>
            </div>
        </section>
    </x-modal>
</div>
