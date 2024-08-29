@section('subhead')
    <title>Sugerencias - {{ config('app.name') }}</title>
@endsection
<div class="mx-2 bg-[#f3faf8]">
    <div class="mb-2  w-full">
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="intro-y mt-8 flex justify-center items-center p-3 m-2">
                    <p class="font-sans text-justify text-sm  sm:text-lg text-cyan-800">
                        <strong> ¡Tu opinión es importante para nosotros!</strong>
                        <br><br>
                        Si has encontrado algún problema o fallo en la herramienta, o si tienes alguna sugerencia para
                        mejorar las funcionalidades existentes, no dudes en dejar tu mensaje. Estamos comprometidos en
                        ofrecer la mejor experiencia posible y agradecemos cualquier comentario que nos ayude a mejorar.
                    </p>
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <div class="w-full my-0 align-middle text-dark border-neutral-200">
                                <form wire:submit="store" wire:key="{{ uniqid() }}"
                                    class="w-full bg-white shadow-md p-3">
                                    <div class="flex flex-wrap -mx-3 mb-5">
                                        <div class="w-full sm:w-full px-3 mb-6">
                                            <div>
                                                <x-custom.input-select wire:model='sugerencias.module'
                                                    id="sugerencias.module" label="Modulos" required>
                                                    <option value="" selected>Seleccione un modulo</option>
                                                    @foreach ($this->modulos as $modulo)
                                                        <option value="{{ $modulo }}">{{ $modulo }}</option>
                                                    @endforeach
                                                </x-custom.input-select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="p-2">Mensaje*</label>
                                            <textarea wire:model="sugerencias.message" required id="sugerencias.message"
                                                class="w-full
                                                transition duration-200 ease-in-out text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 
                                                focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 
                                                 dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100
                                                  disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 
                                                  readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 
                                                  group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l 
                                                  group-[.input-group]:last:rounded-r group-[.input-group]:z-10"
                                                cols="200" rows="6"></textarea>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-3 p-2">
                                        <div>
                                            <input type="file" wire:model="imagen" multiple
                                                class=" items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer 
                                                space-y-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm 
                                                file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                            <div class="flex justify-center">
                                                @if ($this->imagen)
                                                    @foreach ($this->imagen as $imagen)
                                                        <img src="{{ $imagen->temporaryUrl() }}" alt="*"
                                                            class="mt-4 rounded shadow max-w-xs w-64 h-48 p-2">
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <x-custom.modal.footer>
                                        <div class="text-right">
                                            <x-custom.button class="bg-green-300 hover:bg-green-500" type="submit">
                                                Agregar
                                            </x-custom.button>
                                        </div>
                                    </x-custom.modal.footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
