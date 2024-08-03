@section('subhead')
    <title>Auditoría - {{ config('app.name') }}</title>
@endsection
<div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">

    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-nav px-2 py-3 border-white border-b">
            <h2 class="leading-normal font-bold text-2xl text-white">Listado de usuarios</h2>
        </div>
        <div class="p-3">
            <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
                <x-button title="Crear un nuevo usuario"
                    class="mr-2  tooltip inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-light-inverse bg-light-dark border-light shadow-none border-0 py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light"
                    variant="primary" wire:click="$dispatch('openUserModal')">
                    Nuevo Usuario
                </x-button>

                <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto flex gap-x-2">
                    <div class="relative w-56 text-slate-500">
                        <x-input id="search" titleInput="Filtro para búscar usuarios" wire:model.live="search"
                            class="!box w-56 pr-10 tooltip" type="search" placeholder="Búscar..." />
                    </div>
                </div>
            </div>

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <div class="flex flex-wrap -mx-3 mb-5">
                    <div class="w-full max-w-full px-3 mb-6  mx-auto">
                        <div
                            class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                            <div
                                class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                            </div>

                            <!-- card body  -->
                            <div class="flex-auto block p-3">
                                <div class="overflow-x-auto">
                                    <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                        <thead class="align-bottom">
                                            <tr class="font-semibold text-secondary-dark border p-3">
                                                <th class="p-3 text-center">Nombre</th>
                                                <th class="p-3 text-center">Correo</th>
                                                <th class="p-3 text-center">Documento</th>
                                                <th class="p-3 text-center">Telefono</th>
                                                <th class="p-3 text-center">Estado</th>
                                                <th class="p-3 text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($this->users as $user)
                                                <tr
                                                    class="border-b border-dashed last:border-b-0 shadow-sm text-center">
                                                    <td class="p-3">{{ $user->name }}</td>
                                                    <td class="p-3"> {{ $user->email }}</td>
                                                    <td class="p-3">{{ $user->document_number }} </td>
                                                    <td class="p-3">{{ $user->phone }} </td>
                                                    <td class="p-3">
                                                        <i class="fa-solid fa-power-off {{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}"
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
                                                            title="Editar usuario">
                                                            <i class="fas fa-edit"></i></a>
                                                        <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                            title="Eliminar usuario">
                                                            <i class="fas solid fa-trash-can"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td class="text-center text-white dark:bg-darkmode-600 bg-slate-500 font-bold"
                                                    colspan="100">No hay registros disponibles</td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
