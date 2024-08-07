@section('subhead')
    <title>Animales - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2">
    <div class="mb-2 w-full">

        <div class="intro-y mt-8 flex items-center">
            <h2 class="mr-auto text-lg font-medium">Listado de animales</h2>
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
                        <x-custom.button title="Crear un nuevo usuario" :icon="'fas fa-plus'"
                            class="mr-2 bg-blue-700 hover:bg-blue-800 active:bg-blue-900 focus:bg-blue-700 tooltip inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-light-inverse bg-light-dark border-light shadow-none border-0 py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light"
                            variant="primary">
                            Nuevo Animal
                        </x-custom.button>
                    </div>

                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Código</th>
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-center">Reza</th>
                                        <th class="p-3 text-center">Especie</th>
                                        <th class="p-3 text-center">Responsable</th>
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ([] as $audit)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 capitalize text-left">
                                                {{ $audit->user->name }}
                                            </td>
                                            <td class="p-3 text-left"> {{ $audit->email }}</td>
                                            <td class="p-3">{{ $audit->event }} </td>
                                            <td class="p-3">{{ $audit->auditable_type }} </td>
                                            {{ $audit->auditable?->name ?? $audit->auditable_id . ' - (auditable_id)' }}
                                            {{ collect($audit->old_values)->keys()->implode(', ') }}
                                            <td class="p-3">{{ $audit->event }} </td>
                                            <td class="p-3">
                                                <a class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                    title="Ver información completa">
                                                    <i class="fas fa-eye"></i></a>
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
    <div>
        {{--  {{ $this->audits->links() }} --}}
    </div>
</div>
