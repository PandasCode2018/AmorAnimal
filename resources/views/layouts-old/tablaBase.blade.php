@section('subhead')
    <title>Auditoría - {{ config('app.name') }}</title>
@endsection
<div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">

    <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
        <div class="bg-nav px-2 py-3 border-solid border-gwhite border-b font-bold text-2xl text-white">
            Listado de usuarios
        </div>
        <div class="p-3">

            <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
                <x-button title="Crear un nuevo usuario" class="mr-2 shadow-md tooltip" variant="primary"
                    wire:click="$dispatch('openUserModal')">
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
                <table class="table-responsive w-full rounded">
                    <thead>
                        <tr>
                            <th class="border w-1/4 px-4 py-2">Student Name</th>
                            <th class="border w-1/6 px-4 py-2">City</th>
                            <th class="border w-1/6 px-4 py-2">Course</th>
                            <th class="border w-1/6 px-4 py-2">Fee</th>
                            <th class="border w-1/7 px-4 py-2">Status</th>
                            <th class="border w-1/5 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">Micheal Clarke</td>
                            <td class="border px-4 py-2">Sydney</td>
                            <td class="border px-4 py-2">MS</td>
                            <td class="border px-4 py-2">900 $</td>
                            <td class="border px-4 py-2">
                                <i class="fas fa-check text-green-500 mx-2"></i>
                            </td>
                            <td class="border px-4 py-2">
                                <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                    <i class="fas fa-eye"></i></a>
                                <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white">
                                    <i class="fas fa-edit"></i></a>
                                <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
