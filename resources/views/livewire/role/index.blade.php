@section('subhead')
    <title>Roles - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2">
    <div class="mb-2  w-full">
        <div class="mt-5 grid  grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="intro-y mt-8 flex justify-center items-center">
                    <h2 class="font-sans font-bold text-center text-2xl text-cyan-800">Listado de roles</h2>
                </div>
                <div
                    class="intro-y col-span-12 mt-2 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400">

                    <div class="relative w-full sm:w-56 text-slate-500 mb-4 sm:mb-0">
                        <x-input id="search" titleInput="Filtro para buscar usuarios" wire:model.live="search"
                            class="!box w-full sm:w-56 pr-10 tooltip" type="search" placeholder="Buscar..." />
                    </div>

                    <div class="p-2 w-full sm:w-auto">
                        <x-custom.button wire:click="$dispatch('openRolModal')" title="Crear un nuevo usuario"
                            class="w-full sm:w-auto bg-blue-400 hover:bg-blue-500 text-white py-2 px-4 text-base sm:text-sm font-medium">
                            Nuevo Rol
                        </x-custom.button>
                    </div>

                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Indice</th>
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->roles as $index => $role)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 text-left">{{ $index + 1 }}</td>
                                            <td class="p-3 capitalize text-left">{{ $role->name }}</td>

                                            <td class="p-3">
                                                <a wire:click="$dispatch('openRolModal', {id: '{{ $role->id }}'})"
                                                    class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300
                                                    title="Ver
                                                    información completa">
                                                    <i class="fas fa-edit"></i></a>

                                                <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                    title="Eliminar usuario">
                                                    <i class="fas solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="pt-5 text-center text-black dark:bg-darkmode-600 bg-transparent font-bold"
                                            colspan="100">
                                            No hay registros disponibles</td>
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
        {{ $this->roles->links() }}
    </div>

    @push('modals')
        <livewire:role.management />
    @endpush

</div>
