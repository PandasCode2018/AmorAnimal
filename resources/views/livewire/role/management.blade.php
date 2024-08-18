<div>
    <x-modal wire:model='rolModal' maxWidth="2xl" id="manage-rol-modal">
        <div>
            <form wire:submit="store" wire:key="{{ uniqid() }}">
                <div class="p-5">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                        <h3 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                            {{ $role->id ? 'Actualizar rol y permisos' : 'Crear rol y permisos' }}
                        </h3>
                        <button type="button" wire:click='closeModal'
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">

                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-3 mt-2">
                        <div>
                            <x-custom.input wire:model="role.name" id="role.name" label="Nombre" type="text"
                                required />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-3 pt-3 mt-2 overflow-auto max-h-96">
                        <div class="col-span-2 relative overflow-y-auto h-50">
                            <div class="p-2 w-full">
                                <div class="flex-auto block p-3">
                                    <div class="overflow-x-auto lg:overflow-visible">
                                        <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                            <tbody>
                                                @forelse ($this->permissions as $permission)
                                                    <tr
                                                        class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                                        <td class="p-3">
                                                            <div class="flex justify-between items-center">
                                                                <label class="text-left">{{ $permission->name }}</label>
                                                                <input type="checkbox" name="{{ $permission->id }}"
                                                                    value="{{ $permission->name }}"
                                                                    id="permission-{{ $permission->id }}"
                                                                    wire:model="rolePermissions"
                                                                    class="focus:outline-none active:outline-none h-6 w-6 text-green-500">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <td class="pt-5 text-center text-black dark:bg-darkmode-600 bg-transparent font-bold"
                                                        colspan="100">
                                                        No hay registros disponibles
                                                    </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                            {{ $role->id ? 'Actualizar' : 'Guardar' }}
                        </x-custom.button>
                    </div>
                </x-custom.modal.footer>
            </form>
            <x-custom.cargando message="Creando Usuario ..." tarejt="rolModal" />
        </div>
    </x-modal>
</div>
