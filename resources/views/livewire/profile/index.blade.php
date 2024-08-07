@section('subhead')
    <title>Perfil - {{ config('app.name') }}</title>
@endsection
<div class="mx-2">
    <div class="mb-2 w-full">

        <div class="intro-y mt-8 flex items-center">
            <h2 class="mr-auto text-lg font-medium">Configuración de Perfil</h2>
        </div>
        <div class="mt-5 grid grid-cols-12 gap-6">

            <div class="col-span-12 flex flex-col-reverse lg:col-span-4 lg:block 2xl:col-span-2 shadow-lg">
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
                            <div id="profile-tab" selected>
                                <button
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold  text-slate-700 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105  shadow-[0px_3px_20px_#0000000b] rounded-md [&.active]:bg-primary [&.active]:font-medium w-full py-2 active"
                                    as="button">
                                    Usuario
                                </button>
                            </div>
                            <div id="profile-tab" selected>
                                <button
                                    class="cursor-pointer block appearance-none px-5 border border-1 font-bold  text-slate-700 dark:text-slate-400 hover:dark:text-slate-500 hover:scale-105 shadow-[0px_3px_20px_#0000000b] rounded-md [&.active]:bg-primary [&.active]:font-medium w-full py-2 active"
                                    as="button">
                                    Empresa
                                </button>
                            </div>
                        </li>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-10 shadow-lg">
                <div class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">
                    <h2 class="mr-auto text-base font-medium py-5">Información personal</h2>
                </div>
                <div class="p-5 w-full">
                    <form wire:submit="updateUserProfile">
                        <div class="p-5">
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <x-custom.input wire:model="user.name" title="Nombre completo" required
                                        id="user.name" label="Nombre completo" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input title="Correo" disabled readonly id="user.email" label="Correo"
                                        type="email" maxlength="50" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.adrress" title="Direccion" requiered
                                        id="user.adrress" label="Direccion" type="text" maxlength="100" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 pt-3">
                                <div>
                                    <x-custom.input wire:model="user.document_number" title="# Documento" requiered
                                        id="user.document_number" label="# Documento" type="text" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.password" title="Contraseña" required
                                        id="user.password" label="Contraseña actaul" type="password" maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.newPassword" title="Contraseña nueva" required
                                        id="user.newPassword" label="Nueva contraseña" type="password"
                                        maxlength="100" />
                                </div>
                                <div>
                                    <x-custom.input wire:model="user.phone" title="Télefono" requiered id="user.phone"
                                        label="Télefono" type="number" maxlength="15" />
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 pt-3">

                                <div>
                                    <x-custom.input title="Titulo" disabled readonly id="user.qualification"
                                        label="Titulo" type="text" maxlength="100" />
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
            </div>
        </div>
    </div>
</div>
