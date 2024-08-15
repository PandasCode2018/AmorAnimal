<div>
    <x-modal wire:model='estadosModal' maxWidth="md" id="manage-responsible-modal">
        <div class="p-5">
            <div class="flex justify-between items-center py-3 px-4 border-b">
                <h4 class="text-nowrap text-2xl text-gray-800 dark:text-gray-800">
                    Estados disponibles
                </h4>
                <button type="button" wire:click='closeModal'
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-300 hover:bg-gray-200 hover:scale-105 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400">

                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div>
                <div class="grid grid-cols-3 gap-3 p-2">
                    @foreach ($estados as $estado)
                        @if ($estado->id != 1)
                            <x-custom.button class="bg-{{$estado->color}}-300 hover:bg-{{$estado->color}}-500" type="submit">
                                {{ $estado->name_status }}
                            </x-custom.button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </x-modal>
</div>
