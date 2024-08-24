<x-guest-layout>
    @section('subhead')
        <title>Registro - {{ config('app.name') }}</title>
    @endsection

    <div
        class="mx-auto flex justify-center items-center h-screen overflow-hidden bg-gradient-to-b from-[#584a76] to-[#36afe4]">
        <div class="sm:w-1/2 w-full">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12  shadow-2xl bg-white">
                    <div class="intro-y mt-5 sm:flex hidden items-center p-3 m-2">
                        <p class="font-sans text-justify text-sm  sm:text-lg text-slate-900 p-2">
                            <strong> ¡Bienvenido AmorAnimal!</strong>
                            <br>
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

                                        <div x-data="{ open: false }">
                                            <div class="flex items-baseline space-x-2 mt-2">
                                                <input type="checkbox" name="bool_termino_codiciones"
                                                    id="bool_termino_codiciones" class="inline-block">
                                                <a href="#" @click.prevent="open = true"
                                                    class="text-gray-600 text-sm hover:text-blue-500">
                                                    Acepto Términos y condiciones.
                                                </a>
                                            </div>

                                            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-90"
                                                class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
                                                <div class="bg-white rounded-lg shadow-lg w-ull sm:w-1/2 p-6">

                                                    <h2 class="text-xl font-semibold mb-4">Términos y Condiciones para
                                                        la Fase de Pruebas</h2>
                                                    <div class="overflow-y-auto max-h-[70vh]">

                                                        <p class="mb-4">
                                                            Bienvenido a la fase de pruebas de AmorAnimal. Al participar
                                                            en esta fase de pruebas, usted
                                                            acepta los términos y condiciones aquí establecidos. Este
                                                            documento describe cómo se manejará su información personal
                                                            durante el período de pruebas y sus derechos con respecto a
                                                            la misma
                                                        </p>

                                                        <h2 class="text-lg font-semibold mb-4"">Uso de la Aplicación
                                                        </h2>
                                                        <p class="mb-4">
                                                            * La Aplicación se encuentra en una fase de pruebas
                                                            preliminares, por lo que puede contener errores o
                                                            fallos.
                                                            <br>
                                                            * Su participación en estas pruebas es voluntaria, y
                                                            cualquier
                                                            dato proporcionado se utilizará únicamente para mejorar
                                                            la
                                                            calidad y el rendimiento de la Aplicación.
                                                        </p>
                                                        <h2 class="text-lg font-semibold mb-4"">Recopilación de
                                                            Información</h2>
                                                        <p class="mb-4">
                                                            Durante la fase de pruebas, es posible que recopilemos la
                                                            siguiente información:
                                                            <br>
                                                            * Datos de uso de la Aplicación (por ejemplo, cómo
                                                            interactúa
                                                            con la Aplicación).
                                                            <br>
                                                            * Información técnica (como el tipo de dispositivo,
                                                            sistema
                                                            operativo, y datos de conexión).
                                                            <br>
                                                            * Información de contacto si usted decide proporcionarla
                                                            (por
                                                            ejemplo, para recibir actualizaciones o brindar
                                                            comentarios).
                                                        </p>

                                                        <h2 class="text-lg font-semibold mb-4"> Retención y Eliminación
                                                            de Datos</h2>
                                                        <p class="mb-4">
                                                            * Su información se almacenará durante el tiempo que dure
                                                            la fase de pruebas, y podrá ser retenida durante un
                                                            período breve posterior para análisis adicionales.
                                                            <br>
                                                            * Usted tiene el derecho de solicitar la eliminación de su
                                                            información en cualquier momento. Para hacerlo,
                                                            simplemente póngase en contacto con nosotros a través de
                                                            [email/contacto]. Nos comprometemos a eliminar toda su
                                                            información personal de nuestros sistemas dentro de un
                                                            plazo razonable tras recibir su solicitud.
                                                        </p>
                                                        <h2 class="text-lg font-semibold mb-4">Seguridad de los Datos
                                                        </h2>
                                                        <p class="mb-4">Hemos implementado medidas de seguridad para
                                                            proteger su información durante su transmisión y
                                                            almacenamiento. Sin embargo, tenga en cuenta que ningún
                                                            sistema es completamente seguro y no podemos garantizar la
                                                            seguridad absoluta de su información.</p>
                                                        <h2 class="text-lg font-semibold mb-4">Cambios en los Términos y
                                                            Condiciones</h2>
                                                        <p class="mb-4">
                                                            Nos reservamos el derecho de modificar estos términos y
                                                            condiciones en cualquier momento. Le notificaremos cualquier
                                                            cambio significativo a través de [email/medios de contacto].
                                                        </p>
                                                        <h2 class="text-lg font-semibold mb-4">Contacto</h2>
                                                        <p class="mb-4">Si tiene alguna pregunta o inquietud sobre
                                                            estos términos y condiciones, o si desea solicitar la
                                                            eliminación de su información, por favor, contacte con
                                                            nosotros en [email/contacto].</p>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <div class="mt-6 flex justify-end">
                                                        <button @click="open = false" type="button"
                                                            class="bg-blue-400 text-white px-4 py-2 rounded-md">
                                                            Cerrar
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
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
