<div>
    <x-modal wire:model='modalAudit' maxWidth="3xl" id="manage-audit-modal">
        <div class="p-5">
            <div class="mb-5 mt-5 text-3xl text-center">
                Información modificada
            </div>
            <hr class="mb-5">
            <div class="grid grid-cols-2 gap-3">
                <div class="w-full overflow-auto ">
                    <table class="table-auto w-full mb-3 border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th colspan="2"
                                    class="bg-gray-100 text-left font-bold text-lg text-gray-800 p-2 border border-gray-300">
                                    Valores Antiguos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audit->old_values ?? [] as $key => $value)
                                <tr>
                                    <td class="p-2 border border-gray-300 text-sm text-gray-600 font-semibold">
                                        {{ $key }}:</td>
                                    <td class="p-2 border border-gray-300 text-sm text-gray-600">
                                        <div class="overflow-auto">
                                            {{ $value }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="w-full overflow-auto ">
                        <table class="table-auto w-full mb-3 border-collapse border border-gray-200">
                            <thead>
                                <tr>
                                    <th colspan="2"
                                        class="bg-gray-100 text-left font-bold text-lg text-gray-800 p-2 border border-gray-300">
                                        Nuevos Valores</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audit->new_values ?? [] as $key => $value)
                                    <tr>
                                        <td class="p-2 border border-gray-300 text-sm text-gray-600 font-semibold">
                                            {{ $key }}:</td>
                                        <td class="p-2 border border-gray-300 text-sm text-gray-600">
                                            <div class="overflow-auto">
                                                {{ $value }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-custom.modal.footer>
            <div class="text-right">
                <x-custom.button wire:click='closetModal' class="mr-1 w-24" data-tw-dismiss="modal" type="button"
                    variant="outline-secondary">
                    Cerrar
                </x-custom.button>
            </div>
        </x-custom.modal.footer>
    </x-modal>
</div>
