@section('subhead')
    <title>Consultas - {{ config('app.name') }}</title>
@endsection
<div class="mx-2">
    <div class="mb-2 w-full">

        <div class="intro-y mt-8 flex items-center">
            <h2 class="mr-auto text-lg font-medium">Consultas clínicas veterinarias</h2>
        </div>
        <div class="mt-5 grid grid-cols-12 gap-6">

            <div class="col-span-12 flex flex-col-reverse lg:col-span-4 lg:block 2xl:col-span-2 shadow-lg">
                <div class="intro-y box mt-5 lg:mt-0">
                    <div class="relative flex items-center p-5">
                        <div class="">
                            <div class="text-base font-medium">
                                Intervenciones
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-200/60 p-5 dark:border-darkmode-400">
                        <li variant="boxed-tabs" class="flex flex-col gap-y-2">

                            <div id="profile-tab" selected>
                                <button
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold  text-slate-900 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105  shadow-[0px_3px_20px_#0000000b] rounded-md [&.active]:bg-primary [&.active]:font-medium w-full py-2"
                                    as="button">
                                    Tratamiento
                                </button>
                            </div>
                            <div id="profile-tab" selected>
                                <button
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold  text-slate-900 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105 shadow-[0px_3px_20px_#0000000b] rounded-md [&.active]:bg-primary [&.active]:font-medium w-full py-2 active"
                                    as="button">
                                    Vacunas
                                </button>
                            </div>
                            <div id="profile-tab" selected>
                                <button
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold  text-slate-700 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105  shadow-[0px_3px_20px_#0000000b] rounded-md [&.active]:bg-primary [&.active]:font-medium w-full py-2 active"
                                    as="button">
                                    Desparasitación
                                </button>
                            </div>
                        </li>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-10 shadow-lg">


                <div
                    class="intro-y col-span-12 mt-2 flex items-center justify-between  border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 ">

                    <div class="relative w-56 text-slate-500">
                        <x-input id="search" titleInput="Filtro para búscar usuarios" wire:model.live="search"
                            class="!box w-56 pr-10 tooltip" type="search" placeholder="Búscar..." />
                    </div>

                    <div>
                        <x-custom.button x-on:click="showModalUsers=true" title="Crear un nuevo usuario"
                            :icon="'fas fa-plus'"
                            class="mr-2 bg-blue-700 hover:bg-blue-800 active:bg-blue-900 focus:bg-blue-700 tooltip inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-light-inverse bg-light-dark border-light shadow-none border-0 py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light"
                            variant="primary">
                            Nuevo consulta
                        </x-custom.button>
                    </div>
                </div>

                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">#</th>
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-left">Doctor</th>
                                        <th class="p-3 text-left">Fecha</th>
                                        <th class="p-3 text-left">Hora</th>
                                        <th class="p-3 text-center">Estado</th>
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ([] as $consulta)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 capitalize text-left">{{ $consulta->name }}</td>
                                            <td class="p-3 text-left"> {{ $user->email }}</td>
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
</div>
