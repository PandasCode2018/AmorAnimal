@section('subhead')
    <title>Usuarios - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2">
    <div class="mb-2 w-full">
        <div class="intro-y mt-8 flex items-center">
            <h2 class="mr-auto text-lg font-medium">Listado de usuarios</h2>
        </div>

        <div class="mt-5 grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-lg">
                <div
                    class="intro-y col-span-12 mt-2 flex items-center justify-between  border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 ">

                    <div class="relative w-56 text-slate-500">
                        <x-input id="search" titleInput="Filtro para búscar usuarios" wire:model.live="search"
                            class="!box w-56 pr-10 tooltip" type="search" placeholder="Búscar..." />
                    </div>

                    <div>
                        <x-custom.button wire:click="$dispatch('openUserModal')" title="Crear un nuevo usuario"
                            :icon="'fas fa-plus'" class="bg-slate-400 hover:bg-blue-500">
                            Nuevo Usuario
                        </x-custom.button>
                    </div>
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
                                        <th class="p-3 text-center">Estado</th>
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->users as $user)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 capitalize text-left">{{ $user->name }}</td>
                                            <td class="p-3 text-left"> {{ $user->email }}</td>
                                            <td class="p-3">{{ $user->document_number }} </td>
                                            <td class="p-3">{{ $user->phone }} </td>
                                            <td class="p-3">
                                                <i wire:click="changeStatus('users', '{{ $user->uuid }}')"
                                                    class="fa-solid fa-power-off {{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}"
                                                    title="  {{ $user->status == 1 ? 'Activo' : 'Inactivo' }}"></i>
                                                <span
                                                    class="{{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}">

                                                </span>
                                            </td>
                                            <td class="p-3">
                                                <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                    title="Ver información completa">
                                                    <i class="fas fa-eye"></i></a>
                                                <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:cale-110"
                                                    title="Editar usuario"
                                                    wire:click="$dispatch('openUserModal', {userUuid: '{{ $user->uuid }}'})">
                                                    <i
                                                        class="fas
                                                    fa-edit"></i></a>
                                                @if (auth()->id() !== $user->id)
                                                    <a wire:click="delete('users','{{ $user->uuid }}')"
                                                        class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                        title="Eliminar usuario">
                                                        <i class="fas solid fa-trash-can"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-white dark:bg-darkmode-600 bg-slate-500 font-bold"
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
</div>
