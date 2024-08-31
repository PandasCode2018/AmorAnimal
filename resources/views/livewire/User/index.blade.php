@section('subhead')
    <title>Usuarios - {{ config('app.name') }}</title>
@endsection
<div class="mx-2 bg-[#f3faf8] tourUsuarios-0">
    <div class="mb-2 w-full">
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialUsuarios')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y flex justify-center items-center shadow-sm rounded-lg">
                    <h2
                        class="font-serif font-semibold text-center text-3xl text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                        Listado de usuarios
                    </h2>
                </div>
                <div
                    class="intro-y col-span-12 mt-2 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400">
                    <div class="relative w-full sm:w-56 text-slate-500 mb-4 sm:mb-0 tourUsuarios-1">
                        <x-input id="search" titleInput="Filtro para buscar usuarios" wire:model.live="search"
                            class="!box w-full sm:w-56 pr-10 tooltip" type="search" placeholder="Buscar..." />
                    </div>

                    @can('Crear users')
                        <div class="p-2 w-full sm:w-auto tourUsuarios-2">
                            <x-custom.button wire:click="$dispatch('openUserModal')" title="Crear un nuevo usuario"
                                class="w-full sm:w-auto bg-[#7a7cbf] hover:bg-[#6c6ea7] text-white py-2 px-4 text-base sm:text-sm font-medium">
                                Nuevo Registro
                            </x-custom.button>
                        </div>
                    @endcan
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <table class="w-full max-w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-left">Correo</th>
                                        <th class="p-3 text-center">Documento</th>
                                        <th class="p-3 text-center">Teléfono</th>
                                        @can('Editar users')
                                            <th class="p-3 text-center">Estado</th>
                                        @endcan
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->users as $index => $user)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 capitalize text-left">{{ $user->name }}</td>
                                            <td class="p-3 text-left"> {{ $user->email }}</td>
                                            <td class="p-3">{{ $user->document_number }} </td>
                                            <td class="p-3">{{ $user->phone }} </td>
                                            @can('Editar users')
                                                <td class="p-3 tourUsuarios-3">
                                                    <i wire:click="changeStatus('users', '{{ $user->uuid }}')"
                                                        class="fa-solid fa-power-off {{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}"
                                                        title="  {{ $user->status == 1 ? 'Activo' : 'Inactivo' }}"></i>
                                                    <span
                                                        class="{{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}">
                                                    </span>
                                                </td>
                                            @endcan
                                            <td class="p-3">
                                                <a wire:click="$dispatch('detalleUsertoModal', {userUuid: '{{ $user->uuid }}'})"
                                                    class="tourUsuarios-4 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                    title="Ver información completa">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @can('Editar users')
                                                    <a class="tourUsuarios-5 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:cale-110"
                                                        title="Editar"
                                                        wire:click="$dispatch('openUserModal', {userUuid: '{{ $user->uuid }}'})">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('Eliminar users')
                                                    @if (auth()->id() !== $user->id)
                                                        <a wire:click="delete('users','{{ $user->uuid }}')"
                                                            wire:confirm.prompt="{{ $this->confirmQuestion }}"
                                                            class="tourUsuarios-6 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                            title="Eliminar">
                                                            <i class="fas solid fa-trash-can"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="pt-5 text-center text-black dark:bg-darkmode-600 bg-transparent font-bold"
                                            colspan="100">No
                                            hay registros disponibles</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $this->users->links() }}
    </div>
    @push('modals')
        <livewire:user.management />
    @endpush
    @push('modals')
        <livewire:user.detalle />
    @endpush
</div>
