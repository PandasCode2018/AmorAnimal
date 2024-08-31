@section('subhead')
    <title>Auditoria - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2 bg-[#f3faf8] tourAuditoria-0">
    <div class="mb-2  w-full">
        <div class="mt-5 grid  grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialAuditoria')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y flex justify-center items-center shadow-sm rounded-lg">
                    <h2
                        class="font-serif font-semibold text-center text-3xl text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                        Listado de acciones en el sistema
                    </h2>
                </div>
                <div
                    class="intro-y col-span-12 mt-2 flex items-center justify-between  border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 ">

                    <div class=" tourAuditoria-1 relative w-56 text-slate-500">
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
                                        <th class="p-3 text-left">Usuario</th>
                                        <th class="p-3 text-left">Fecha</th>
                                        <th class="p-3 text-left">Hora</th>
                                        <th class="p-3 text-left">Acción</th>
                                        <th class="p-3 text-center">Módulo</th>
                                        <th class="p-3 text-center">Valores</th>
                                        @can('Ver auditorias')
                                            <th class="p-3 text-center">Detalle</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->Audits as $audit)
                                        <tr
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 capitalize text-left">{{ $audit->user->name }}</td>
                                            <td class="p-3 text-left">
                                                {{ \Carbon\Carbon::parse($audit->created_at)->format('Y-m-d') }}
                                            </td>
                                            <td class="p-3 text-left">
                                                {{ \Carbon\Carbon::parse($audit->created_at)->format('h-i-A') }}
                                            </td>
                                            <td class="p-3 text-left">{{ $audit->event }} </td>
                                            <td class="p-3">{{ Str::afterLast($audit->auditable_type, '\\') }}</td>
                                            <td class="p-3">
                                                {{ $audit->auditable?->name }}
                                            </td>
                                            @can('Ver auditorias')
                                                <td class="p-3">
                                                    <a wire:click="$dispatch('openModalAudit', {audit: '{{ $audit->id }}'})"
                                                        class="tourAuditoria-2 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-blue-500"
                                                        title="Ver información completa">
                                                        <i class="fas fa-eye"></i></a>
                                                </td>
                                            @endcan
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
