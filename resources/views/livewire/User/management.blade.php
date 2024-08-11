<div>
    <x-modal wire:model='userModal' maxWidth="3xl" id="manage-user-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                        {{ $user->id ? 'Actualizar usuario' : 'Crear usuario' }}
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
                    <div class="grid grid-cols-2 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model='user.name' id="user.name" label="Nombre" type="text"
                                required />
                            @error('user.name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='user.document_number' id="user.document_number"
                                label="Documento" type="number" required />
                            @error('user.document_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model="user.phone" id="user.phone" label="Telefono" type="number"
                                maxlength="12" />
                            @error('user.phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model="user.email" id="user.email" label="Correo" type="email"
                                required />
                            @error('user.email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model="user.address" id="user.address" label="Dirección" type="text"
                                required />
                            @error('user.address')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-3 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model="user.qualification" id="user.qualification" label="Titulo"
                                type="text" />
                            @error('user.qualification')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model="user.specialty" id="user.specialty" label="Especialización"
                                type="text" />
                            @error('user.specialty')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model="user.license_number" id="user.license_number" label="Licencia"
                                type="text" />
                            @error('user.license_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model="user.years_experience" id="user.years_experience"
                                label="Años de experiencia" type="number" maxlength="2" />
                            @error('user.years_experience')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model="user.password" id="user.password" label="Contraseña"
                                type="password" />
                            @error('user.password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input id="user.userRolesName" label="Roles" type="text" />
                            @error('user.userRolesName')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

            </div>
            <x-custom.modal.footer>
                <div class="text-right">
                    {{-- <x-custom.button class="bg-slate-400 hover:bg-red-500" type="button" wire:click="closeModal">
                        Cancelar
                    </x-custom.button> --}}
                    <x-custom.button class="bg-green-300 hover:bg-green-500 " type="submit">
                        {{ $user->id ? 'Actualizar' : 'Guardar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>
