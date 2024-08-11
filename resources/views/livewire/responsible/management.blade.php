<div>
    <x-modal wire:model='responsibleModal' maxWidth="2xl" id="manage-responsible-modal">
        <form wire:submit="store" wire:key="{{ uniqid() }}">
            <div class="p-5">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                        {{ $responsible->id ? 'Actualizar responsable' : 'Crear responsable' }}
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
                   {{--  <x-custom.button class="bg-slate-400 hover:bg-red-500" type="button" wire:click="closeModal">
                        Cancelar
                    </x-custom.button> --}}
                    <x-custom.button class="bg-green-300 hover:bg-green-500 " type="submit">
                        {{ $responsible->id ? 'Actualizar' : 'Guardar' }}
                    </x-custom.button>
                </div>
            </x-custom.modal.footer>
        </form>
    </x-modal>
</div>
