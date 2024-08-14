@section('subhead')
    <title>Auditoria - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2">
    <div class="mb-2  w-full">

        <div class="intro-y mt-8 flex items-center">
            <h2 class="mr-auto text-lg leading-mediun">Listado de acciones en el sistema</h2>
        </div>
        <div class="mt-5 grid  grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-lg">
                <div
                    class="intro-y col-span-12 mt-2 flex items-center justify-between  border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 ">

                    <div class="relative w-56 text-slate-500">
                        <x-input id="search" titleInput="Filtro para búscar usuarios" wire:model.live="search"
                            class="!box w-56 pr-10 tooltip" type="search" placeholder="Búscar..." />
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Indice</th>
                                        <th class="p-3 text-left">Responsable</th>
                                        <th class="p-3 text-left">Acción</th>
                                        <th class="p-3 text-center">Módulo</th>
                                        <th class="p-3 text-center">Valores</th>
                                        <th class="p-3 text-center">Campos</th>
                                        <th class="p-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->Audits as $index => $audit)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 text-left">{{ $index+1 }}</td>
                                            <td class="p-3 capitalize text-left">{{ $audit->user->name }}</td>
                                            <td class="p-3 text-left">{{ $audit->event }} </td>
                                            <td class="p-3">{{ Str::afterLast($audit->auditable_type, '\\') }}</td>
                                            <td class="p-3">
                                                {{ $audit->auditable?->name }}
                                            </td>
                                            <td class="p-3">
                                                {{ Str::limit(collect($audit->old_values)->keys()->implode(', '),20,'...') }}
                                            </td>
                                            <td class="p-3">
                                                <a wire:click="$dispatch('openModalAudit', {audit: '{{ $audit->id }}'})"
                                                    class="bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                    title="Ver información completa">
                                                    <i class="fas fa-eye"></i></a>

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
    <div>
        {{ $this->audits->links() }}
    </div>

    @push('modals')
        <livewire:Audit.management />
    @endpush

</div>
