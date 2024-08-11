@section('subhead')
    <title>Perfil - {{ config('app.name') }}</title>
@endsection

<div class="mx-2" x-data="{ tabs: 'usuario' }">
    <div class="mb-2 w-full">
        <div class="intro-y mt-8 flex items-center shadow-inner">
            <h2 class="mr-auto text-lg font-medium">Configuración de Perfil</h2>
        </div>
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 flex flex-col-reverse lg:col-span-4 lg:block 2xl:col-span-2 shadow-md">
                <div class="intro-y box mt-5 lg:mt-0">
                    <div class="relative flex items-center p-5">
                        <div class="image-fit h-12 w-12">
                            <img class="rounded-full"
                                src="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/e40b6ea6361a1abe28f32e7910f63b66/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg"
                                alt="Foto" />
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="text-base font-medium">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-200/60 p-5 dark:border-darkmode-400">
                        <li variant="boxed-tabs" class="flex flex-col gap-y-2">
                            <!-- Botón para Usuario -->
                            <div id="profile-tab" selected>
                                <button x-on:click="tabs = 'usuario'"
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold text-slate-700 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105 shadow-[0px_3px_20px_#0000000b] rounded-md w-full py-2">
                                    Usuario
                                </button>
                            </div>
                            <!-- Botón para Empresa -->
                            <div id="company-tab" selected>
                                <button x-on:click="tabs = 'empresa'"
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold text-slate-700 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105 shadow-[0px_3px_20px_#0000000b] rounded-md w-full py-2">
                                    Empresa
                                </button>
                            </div>
                        </li>
                    </div>
                </div>
            </div>

            <!-- Div para Usuario -->
            <div x-show="tabs == 'usuario'" x-transition class="col-span-12 lg:col-span-8 2xl:col-span-10 shadow-2xl">
                <div class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">
                    <h2 class="mr-auto text-base font-medium py-5">Información personal</h2>
                </div>
                <div class="p-5 w-full">
                    <form wire:submit="updateUserProfile" wire:key="{{ uniqid() }}">
                        <div class="p-5">
                            <div class="grid grid-cols-3 gap-3 pb-3">
                                <div>
                                    <x-custom.input wire:model="user.name" title="Nombre completo" required
                                        id="user.name" label="Nombre completo" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.email" title="Correo" disabled readonly
                                        id="user.email" label="Correo" type="email" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.address" title="Direccion" required
                                        id="user.address" label="Direccion" type="text" maxlength="100" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 pt-3 pb-3">
                                <div>
                                    <x-custom.input wire:model="user.document_number" title="Documento" required
                                        id="user.document_number" label="Documento" type="number" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.password" title="Contraseña" required
                                        id="user.password" label="Contraseña actual" type="password" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.newPassword" title="Contraseña nueva" required
                                        id="user.newPassword" label="Nueva contraseña" type="password"
                                        maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.phone" title="Teléfono" required id="user.phone"
                                        label="Teléfono" type="number" maxlength="15" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 pt-3 pb-3">
                                <div>
                                    <x-custom.input wire:model='user.qualification' title="Título" disabled readonly
                                        id="user.qualification" label="Título" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model='user.specialty' title="Especialización" disabled
                                        readonly id="user.specialty" label="Especialización" type="text"
                                        maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model='user.years_experience' title="Años de experiencia"
                                        disabled readonly id="user.years_experience" label="Años de experiencia"
                                        type="number" maxlength="10" />
                                </div>
                                <div>
                                    <x-custom.input wire:model='user.license_number' title="Licencia" disabled readonly
                                        id="user.license_number" label="Licencia" type="text" maxlength="100" />
                                </div>
                            </div>


                            <div class="grid grid-cols-1 gap-3 pt-3">
                                <div>
                                    <input type="file" wire:model="image"
                                        class=" items-center p-4 gap-3 rounded-3xl border border-gray-300 border-dashed bg-gray-50 cursor-pointer space-y-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

                                    @if ($imagePreview)
                                        <img src="{{ $imagePreview }}" alt="Image Preview"
                                            class="mt-4 rounded shadow max-w-xs w-64 h-48">
                                    @endif

                                    @error('animal.foto')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <x-custom.modal.footer>
                            <div class="text-right">
                                <x-custom.button class="bg-slate-400 hover:bg-green-500 " type="submit">
                                    Actualizar
                                </x-custom.button>
                            </div>
                        </x-custom.modal.footer>
                    </form>
                </div>
            </div>


            <!-- Div para Empresa -->
            {{--  <div x-show="tabs == 'empresa'" x-transition class="col-span-12 lg:col-span-8 2xl:col-span-10 border-1 shadow-2xl">
                <div class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">
                    <h2 class="mr-auto text-base font-medium py-5">Información Empresarial</h2>
                </div>
                <div class="p-5 w-full">
                    <form wire:submit="updateUserProfile">
                        <div class="p-5">
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <x-custom.input wire:model.live="user.name" title="Nombre completo" required
                                        id="user.name" label="Nombre completo" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input title="Correo" disabled readonly id="user.email" label="Correo"
                                        type="email" maxlength="50" />
                                </div>
                                <div>
                                    <x-custom.input wire:model.live="user.adrress" title="Dirección" required
                                        id="user.adrress" label="Dirección" type="text" maxlength="100" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 pt-3">
                                <div>
                                    <x-custom.input wire:model.live="user.document_number" title="# Documento" required
                                        id="user.document_number" label="# Documento" type="text"
                                        maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model.live="user.password" title="Contraseña" required
                                        id="user.password" label="Contraseña actual" type="password"
                                        maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model.live="user.newPassword" title="Contraseña nueva" required
                                        id="user.newPassword" label="Nueva contraseña" type="password"
                                        maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model.live="user.phone" title="Teléfono" required id="user.phone"
                                        label="Teléfono" type="number" maxlength="15" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 pt-3">
                                <div>
                                    <x-custom.input title="Título" disabled readonly id="user.qualification"
                                        label="Título" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input title="Especialización" disabled readonly id="user.specialty"
                                        label="Especialización" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input title="Años de experiencia" disabled readonly
                                        id="user.years_experience" label="Años de experiencia" type="number"
                                        maxlength="10" />
                                </div>
                                <div>
                                    <x-custom.input title="#Licencia" disabled readonly id="user.license_number"
                                        label="# Licencia" type="text" maxlength="100" />
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-5 text-right mt-5">
                            <div class="inline-flex items-end">
                                <x-custom.button>Actualizar</x-custom.button>
                            </div>
                        </div>
                        <div class="text-gray-600">
                            <input type="file" name="" id="">
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</div>
