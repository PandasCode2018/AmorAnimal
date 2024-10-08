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
                    <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                        <div>
                            <x-custom.input wire:model='user.name' id="user.name" label="Nombre" type="text"
                                required />
                        </div>
                        <div>
                            <x-custom.input wire:model='user.document_number' id="user.document_number"
                                label="Documento" type="number" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-3">
                        <div>
                            <x-custom.input wire:model="user.phone" id="user.phone" label="Telefono" type="number"
                                maxlength="12" />
                        </div>
                        <div>
                            <x-custom.input wire:model="user.email" id="user.email" label="Correo" type="email"
                                required />
                        </div>
                        <div>
                            <x-custom.input wire:model="user.address" id="user.address" label="Dirección" type="text"
                                required />
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-3">
                        <div>
                            <x-custom.input wire:model="user.qualification" id="user.qualification" label="Titulo"
                                type="text" />
                        </div>
                        <div>
                            <x-custom.input wire:model="user.specialty" id="user.specialty" label="Especialización"
                                type="text" />
                        </div>
                        <div>
                            <x-custom.input wire:model="user.license_number" id="user.license_number" label="Licencia"
                                type="text" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-3">
                        <div>
                            <x-custom.input wire:model="user.years_experience" id="user.years_experience"
                                label="Años de experiencia" type="number" maxlength="2" />
                        </div>
                        @if ($user->id)
                            <div>
                                <x-custom.input wire:model="user.password" id="user.password" label="Contraseña"
                                    type="password" />
                            </div>
                        @endif
                        <div>
                            <x-custom.input-select class="tom-select" id="userRolesName" name="userRolesName"
                                wire:model="userRolesName" label="Rol" required>
                                <option value="" selected>Seleccione un rol</option>
                                @foreach ($this->selectRoles as $rol)
                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @endforeach
                            </x-custom.input-select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-3">
                        <div class="flex items-center mt-2">
                            <input wire:model="user.bool_doctor" type="checkbox" id="user.bool_doctor"
                                name="user.bool_doctor" @if ($user->bool_doctor) checked @endif
                                class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="user.bool_doctor"
                                class="ml-3 text-sm font-semibold text-gray-700 cursor-pointer hover:text-blue-600 transition-colors duration-200 ease-in-out">
                                ¿Es doctor?
                            </label>
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
                        {{ $user->id ? 'Actualizar' : 'Guardar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
        <x-custom.cargando message="Creando Usuario ..." tarejt="store" />
    </x-modal>
</div>
