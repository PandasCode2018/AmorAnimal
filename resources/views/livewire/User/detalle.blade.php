<div>
    <x-modal wire:model='detalleUsertoModal' maxWidth="4xl" id="manage-detalleUser-modal">
        <div class="flex justify-between items-center py-3 px-4 border-b">
            <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800"> Detalle de {{ $user->name ?? '' }}</h3>
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
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-3 pt-4 bg-white flex items-center">
                <img class="w-50 h-40 border mx-auto"
                    src="{{ Auth::user()->profile_photo_path ? Storage::url(Auth::user()->profile_photo_path) : asset('img_sistema/perfil.png') }}"
                    alt="Profile Photo">
            </div>
            <div class="col-span-12 lg:col-span-9 grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-4 m-4">

                <div>
                    <label class="font-medium text-gray-700">Email:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->email ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Documento:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->document_number ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Teléfono:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->phone ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Dirección:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->address ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Calificación:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->qualification ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Especialidad:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->specialty ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Licencia:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->license_number ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Experiencia:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->years_experience ?? '' }}" disabled>
                </div>
                <div>
                    <label class="font-medium text-gray-700">Estado:</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        value="{{ $user->status ?? null == 1 ? 'Activo' : 'Inactivo' }}" disabled>
                </div>
            </div>
        </div>

    </x-modal>
</div>
