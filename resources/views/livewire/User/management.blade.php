<div>
    <x-modal wire:model='userModal' maxWidth="3xl" id="manage-user-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="mb-3 mt-2 text-nowrap text-2xl text-center">
                    {{ !$user ? 'Crear usuario' : 'Actualizar usuario' }}
                </div>
                {{ $user->license_number }}
                <hr class="mb-5">
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
                                type="number" />
                            @error('user.license_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model="user.years_experience" id="user.years_experience"
                                label="Años de experiencia" type="number" />
                            @error('user.years_experience')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model="user.password" id="user.password" label="Contraseña"
                                type="password" required />
                            @error('user.years_experience')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input id="user.rol" label="Roles" type="text" />
                            @error('user.rol')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

            </div>
            <x-custom.modal.footer>
                <div class="text-right">
                    <x-custom.button class="bg-slate-400 hover:bg-red-500" type="button"
                        wire:click="$set('userModal', false)" {{--  wire:click="$dispatch('closetModal')"  --}}>
                        Cancelar
                    </x-custom.button>
                    <x-custom.button class="bg-slate-400 hover:bg-green-500 " type="submit">
                        {{ $user ? 'Guardar' : 'Actualizar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>
