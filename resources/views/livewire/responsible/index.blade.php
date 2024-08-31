@section('subhead')
    <title>Responsable - {{ config('app.name') }}</title>
@endsection
<div class="mx-2 bg-[#f3faf8] tourResponsables-0">
    <div class="mb-2 w-full">
        <div class="mt-5 grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialResponsables')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y flex justify-center items-center shadow-sm rounded-lg">
                    <h2
                        class="font-serif font-semibold text-center text-3xl text-cyan-900 mb-4 border-b-4 border-cyan-500 pb-2">
                        Listado de responsables
                    </h2>
                </div>

                <div
                    class="intro-y col-span-12 mt-2 flex flex-col sm:flex-row items-center justify-between border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400">

                    <div class="tourResponsables-2 relative w-full sm:w-56 text-slate-500 mb-4 sm:mb-0">
                        <x-input id="search" titleInput="Filtro para buscar" wire:model.live="search"
                            class="!box w-full sm:w-56 pr-10 tooltip" type="search" placeholder="Buscar..." />
                    </div>

                    <div class="p-2 w-full sm:w-auto">
                        @can('Crear responsibles')
                            <x-custom.button wire:click="$dispatch('openResponsibleModal')" title="Crear un nuevo usuario"
                                class="tourResponsables-1 w-full sm:w-auto bg-[#7a7cbf] hover:bg-[#6c6ea7] text-white py-2 px-4 text-base sm:text-sm font-medium">
                                Nuevo Responsable
                            </x-custom.button>
                        @endcan
                    </div>

                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto">
                            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-secondary-dark border p-3">
                                        <th class="p-3 text-left">Nombre</th>
                                        <th class="p-3 text-left">Correo</th>
                                        <th class="p-3 text-center">Teléfono</th>
                                        <th class="p-3 text-center">Documento</th>
                                        <th class="p-3 text-center">Dirección</th>
                                        @canany(['Eliminar responsibles', 'Editar responsibles'])
                                            <th class="p-3 text-center">Acciones</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->Responsibles as $index => $Responsible)
                                        <tr wire:key="{{ uniqid() }}"
                                            class="border-b border-dashed last:border-b-0 shadow-sm text-center transform transition-all duration-200 hover:shadow-md hover:scale-15 hover:border-dashed hover:border-b hover:border-blue-200">
                                            <td class="p-3 capitalize text-left">{{ $Responsible->name }}</td>
                                            <td class="p-3 text-left"> {{ $Responsible->email }}</td>
                                            <td class="p-3">{{ $Responsible->phone }} </td>
                                            <td class="p-3">{{ $Responsible->document_number }} </td>
                                            <td class="p-3">{{ $Responsible->address }} </td>
                                            <td class="p-3">
                                                @can('Editar responsibles')
                                                    <a class="tourResponsables-4 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-yellow-300 hover:cale-110"
                                                        title="Editar"
                                                        wire:click="$dispatch('openResponsibleModal', {responbibleUuid:'{{ $Responsible->uuid }}'})">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('Eliminar responsibles')
                                                    <a class="tourResponsables-3 bg-slate-400 cursor-pointer rounded p-1 mx-1 text-white hover:bg-red-500"
                                                        title="Eliminar"
                                                        wire:click="delete('responsibles','{{ $Responsible->uuid }}')"
                                                        wire:confirm.prompt="{{ $this->confirmQuestion }}">
                                                        <i class="fas solid fa-trash-can"></i>
                                                    @endcan
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
        {{ $this->Responsibles->links() }}
    </div>
</div>


@push('modals')
    <livewire:responsible.management />
@endpush
