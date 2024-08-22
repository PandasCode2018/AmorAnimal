<x-guest-layout>
    @section('subhead')
        <title>Registro - {{ config('app.name') }}</title>
    @endsection

    <div
        class="mx-auto flex justify-center items-center h-screen overflow-hidden bg-gradient-to-b from-[#584a76] to-[#36afe4]">
        <div class="sm:w-1/2 w-full">
            <div class="mt-5 grid grid-cols-12 gap-6">
                <div class="col-span-12  shadow-2xl bg-white">
                    <div class="intro-y mt-8 sm:flex hidden items-center p-3 m-2">
                        <p class="font-sans text-justify text-sm  sm:text-lg text-slate-900">
                            <strong> ¡Bienvenido AmorAnimal!</strong>
                            <br><br>
                            Nuestra plataforma te permite mantener un control detallado de la salud y
                            tratamientos de tus animales, todo desde un solo lugar. Al registrarte, tendrás acceso a
                            herramientas avanzadas que te ayudarán a optimizar el bienestar de tus animales,
                            Ya sea que manejes una granja, un refugio,
                            o simplemente desees llevar un control riguroso de tus mascotas.
                        </p>
                    </div>
                    <div class="p-2 w-full ">
                        <div class="flex-auto block p-3">
                            <div class="overflow-x-auto lg:overflow-visible">
                                <div class="w-full text-dark border-neutral-200">

                                    <form wire:submit="store" wire:key="{{ uniqid() }}">

                                        <div>
                                            <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                                                <div>
                                                    <x-custom.input wire:model='company.name' id="company.name"
                                                        label="Organización" type="text" required />
                                                </div>
                                                <div>
                                                    <x-custom.input wire:model='company.nit' id="company.nit"
                                                        label="Nit" type="text" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                                                <div>
                                                    <x-custom.input wire:model='company.email' id="company.email"
                                                        label="Correo" type="text" required />
                                                </div>
                                                <div>
                                                    <x-custom.input wire:model='company.address' id="company.address"
                                                        label="Dirección" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                                                <div>
                                                    <x-custom.input wire:model='company.phone' id="company.phone"
                                                        label="Teléfono" type="text" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-baseline space-x-2 mt-2">
                                            <input type="checkbox" name="" id="" class="inline-block">
                                            <a href="{{-- {{ route('policy') }} --}}"
                                                class="text-gray-600 text-sm hover:text-blue-500">Acepto
                                                Termino y condiciones.</a>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="list-disc list-inside">
                                                        @foreach ($errors->all() as $error)
                                                            <li class="text-red-500">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <x-custom.modal.footer>
                                            <div class="text-right">
                                                <a class=" p-3  text-sm text-gray-600 hover:text-blue-300 rounded-md focus:outline-none"
                                                    href="{{ route('login') }}">
                                                    {{ __('Ya estas registrado?') }}
                                                </a>
                                                <x-custom.button class="bg-green-300 hover:bg-green-500 "
                                                    type="submit">
                                                    Registrar
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
</x-guest-layout>
