<div>
    <x-modal wire:model='responsibleModal' maxWidth="2xl" id="manage-responsible-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="mb-3 mt-2 text-nowrap text-2xl text-center">
                    {{ $responsible->id ? 'Actualizar responsable' : 'Crear responsable' }}
                </div>
                <hr class="mb-5">
                <div>
                    <div class="grid grid-cols-2 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model='responsible.name' id="responsible.name" label="Nombre"
                                type="text" required />
                            @error('responsible.name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='responsible.email' id="responsible.email" label="Correo"
                                type="email" required />
                            @error('responsible.email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model='responsible.phone' id="responsible.phone" label="Telefono"
                                type="number" required />
                            @error('responsible.phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-custom.input wire:model='responsible.address' id="responsible.address" label="Dirección"
                                type="text" required />
                            @error('responsible.address')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 p-2">
                        <div>
                            <x-custom.input wire:model='responsible.document_number' id="responsible.document_number"
                                label="Documento" type="number" required />
                            @error('responsible.document_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($responsible->id)
                            <div>
                                <x-custom.input wire:model='responsible.currenPassword' id="responsible.password"
                                    label="Contraseña" type="password" />
                                @error('responsible.password')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <x-custom.modal.footer>
                <div class="text-right">
                    <x-custom.button class="bg-slate-400 hover:bg-red-500" type="button" wire:click="closetModal">
                        Cancelar
                    </x-custom.button>
                    <x-custom.button class="bg-slate-400 hover:bg-green-500 " type="submit">
                        {{ $responsible->id ? 'Actualizar' : 'Guardar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>
