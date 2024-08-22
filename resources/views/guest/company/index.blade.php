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

                                    <form action="{{ route('public.company.store') }}" method="POST">
                                        @csrf

                                        <div>
                                            <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                                                <div>
                                                    <label>Organización *</label>
                                                    <input type="text" name="name_company" id="name_company"
                                                        value="{{ old('name_company') }}"
                                                        class="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                </div>
                                                <div>
                                                    <div>
                                                        <label>Nit *</label>
                                                        <input type="text" name="nit" id="nit"
                                                            value="{{ old('nit') }}"
                                                            class="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                                                <div>
                                                    <label>Correo *</label>
                                                    <input type="text" name="email" id="email"
                                                        value="{{ old('email') }}"
                                                        class="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                </div>
                                                <div>
                                                    <label>Dirección *</label>
                                                    <input type="text" name="address" id="address"
                                                        value="{{ old('address') }}"
                                                        class="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="grid grid-cols-1 gap-3 p-2 sm:grid-cols-2">
                                                <div>
                                                    <label>Teléfono *</label>
                                                    <input type="text" name="phone" id="phone"
                                                        value="{{ old('phone') }}"
                                                        class="transition duration-200 ease-in-out w-full text-sm  border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-2 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800  dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent readonly:bg-slate-100 readonly:cursor-not-allowed readonly:dark:bg-darkmode-800/50 readonly:dark:border-transparent group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-baseline space-x-2 mt-2">
                                            <input type="checkbox" name="bool_termino_codiciones"
                                                id="bool_termino_codiciones" class="inline-block">
                                            <a href="{{-- {{ route('policy') }} --}}"
                                                class="text-gray-600 text-sm hover:text-blue-500">Acepto
                                                Termino y condiciones.</a>
                                        </div>

                                        <div class="flex items-center justify-star mt-4">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="list-disc list-inside">
                                                        @foreach ($errors->all() as $error)
                                                            <li class="text-red-500">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    <ul class="list-disc list-inside">
                                                        <li class="text-red-500">{{ session('error') }}</li>
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
