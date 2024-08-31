<div>
    <x-modal wire:model='detalleUsertoModal' maxWidth="3xl" id="manage-detalleUser-modal">
        <div class="flex justify-end items-center py-3 px-4 border-b">
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
        <section class="w-full overflow-hidden bg-white text-slate-900">
            <div class="flex flex-col">
                <!-- Profile Image -->
                <div class="sm:w-[80%] xs:w-[90%] mx-auto flex flex-col items-center">
                    <img src="{{ $user->profile_photo_path ?? '' ? Storage::url($user->profile_photo_path) : asset('img_sistema/perfil.png') }}"
                        alt="User Profile"
                        class="rounded-md lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem]" />

                    <!-- FullName -->
                    <h1
                        class="w-full text-center mt-4 sm:mx-4  lg:text-4xl md:text-3xl sm:text-3xl xs:text-xl font-serif">
                        {{ $user->name ?? '' }}
                    </h1>
                </div>


                <dl
                    class="col-span-12 lg:col-span-9 grid grid-cols-1 md:grid-cols-3 gap-4 p-4 m-4">
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Correo</dt>
                        <dd class="text-lg font-semibold">{{ $user->email ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Documento</dt>
                        <dd class="text-lg font-semibold">{{ $user->document_number ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Teléfono</dt>
                        <dd class="text-lg font-semibold">{{ $user->phone ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">titulo</dt>
                        <dd class="text-lg font-semibold">{{ $user->qualification ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Expecialización</dt>
                        <dd class="text-lg font-semibold">{{ $user->specialty ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Numero de licencia</dt>
                        <dd class="text-lg font-semibold">{{ $user->license_number ?? '' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Años de experiencia</dt>
                        <dd class="text-lg font-semibold">{{ $user->years_experience ?? '' }} Años</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Estado</dt>
                        <dd class="text-lg font-semibold">{{ $user->status ?? '' == 1 ? 'Activo' : 'Inactivo' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Doctor</dt>
                        <dd class="text-lg font-semibold">{{ $user->bool_doctor ?? '' == 1 ? 'Si' : 'No' }}</dd>
                    </div>
                    <div class="border-b">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dirección</dt>
                        <dd class="text-lg font-semibold">{{ $user->address ?? '' }}</dd>
                    </div>
                </dl>
            </div>
        </section>
    </x-modal>
</div>
