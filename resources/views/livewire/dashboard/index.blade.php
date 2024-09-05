@section('subhead')
    <title>Inicio - {{ config('app.name') }}</title>
@endsection
<div class="mx-2 bg-[#f3faf8] dashboard-0">
    <div class="mb-2  w-full">
        <div class="mt-3 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="col-span-12 lg:col-span-12 2xl:col-span-12 flex justify-end">
                    <button wire:click="$dispatch('tutorialDashboard')"
                        class="flex items-center px-4 py-2 bg-white text-blue-300 font-semibold rounded-lg shadow-xs hover:shadow-lg hover:text-blue-400 focus:outline-none ">
                        <i class="fas fa-question-circle mr-2"></i>
                        Tutorial
                    </button>
                </div>
                <div class="p-2 w-full">
                    <div class="flex-auto block p-2">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <div class="rounded-3xl p-5 mb-3">
                                <h1 class="text-lg sm:text-3xl font-bold sm:mb-7 flex items-center">
                                    <img src="{{ asset('img_sistema/panda-code.ico') }}" alt="Logo"
                                        class="w-12 h-12 mr-3">
                                    ¡Bienvenidos a AmorAnimal!
                                </h1>

                                <div class="items-center justify-between hidden sm:block">
                                    <div class="flex items-stretch">
                                        <div class="text-gray-400 text-xs"></div>
                                        <div class="h-100 border-l mx-4"></div>
                                        <div class="flex flex-nowrap -space-x-3">
                                            Nos complace enormemente tenerte aquí como parte de nuestra comunidad. En
                                            AmorAnimal, nos dedicamos con pasión y compromiso a brindar el mejor cuidado
                                            y atención a los animales que tanto amamos. Tu confianza en nosotros es un
                                            honor, y estamos aquí para asegurarnos de que cada mascota reciba el amor y
                                            el cuidado que merece.<br>
                                            Gracias por elegirnos. ¡Estamos emocionados de ser parte del bienestar de
                                            tus compañeros de vida!
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2 sm:my-10">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-20">
                                    <div class="hidden sm:block">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <!-- Cuadro de bienvenida -->
                                            <div class="col-span-1 md:col-span-2 lg:col-span-2">
                                                <div
                                                    class="dashboard-1 p-6 bg-gradient-to-r from-green-400 to-blue-500 shadow-lg rounded-xl text-white">
                                                    <div class="font-bold text-lg leading-none capitalize">
                                                        Bienvenido, <br><span
                                                            class="pl-2">{{ Auth::user()->name }}</span>
                                                    </div>
                                                    <div class="mt-4">
                                                        <a target="_blank"
                                                            href="https://wa.me/573234030976?text=Hola%2C%20me%20comunico%20por%20la%20plataforma%20Amor%20Animal."
                                                            type="button"
                                                            class="inline-flex items-center justify-center py-2 px-4 rounded-full bg-white text-gray-800 hover:bg-gray-200 text-sm font-semibold transition">
                                                            Escríbenos si tienes algún problema.
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-5 bg-white rounded shadow-sm dashboard-2">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 rounded-full bg-fuchsia-50 text-fuchsia-400">
                                                        <i class="fas fa-paw text-2xl"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-gray-400"> <a
                                                                href="{{ route('animal.index') }}">Animales
                                                            </a> </div>
                                                        <div class="text-2xl font-bold text-gray-900">
                                                            {{ $this->totalAnimales }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-5 bg-white rounded shadow-sm dashboard-3">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 rounded-full bg-cyan-50 text-cyan-400">
                                                        <i class="fas fa-clock text-2xl"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-gray-400"> <a
                                                                href="{{ route('consultation.index') }}">
                                                                Refuerzo en tratamiento </a> </div>
                                                        <div class="text-2xl font-bold text-gray-900">
                                                            {{ $this->totalConsultasPsotergadas }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-5 bg-white rounded shadow-sm dashboard-4">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 rounded-full bg-cyan-50 text-cyan-400">
                                                        <i class="fas fa-stethoscope text-2xl"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-gray-400"> <a
                                                                href="{{ route('consultation.index') }}"> Total de
                                                                Consultas </a></div>
                                                        <div class="text-2xl font-bold text-gray-900">
                                                            {{ $this->totalConsultas }}</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="p-5 bg-white rounded shadow-sm dashboard-5">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-50 text-emerald-400">
                                                        <i class="fas fa-users fa-lg"></i>
                                                    </div>

                                                    <div>
                                                        <div class="text-gray-400"> <a
                                                                href="{{ route('responsible.index') }}">
                                                                Responsables</a> </div>
                                                        <div class="text-2xl font-bold text-gray-900">
                                                            {{ $this->totalResponsables }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-2 mt-2 w-full">
                                        <h2 class="text-lg sm:text-2xl font-bold mb-4 w-full">Información del sistema
                                        </h2>

                                        <div class="space-y-4">
                                            <div class="p-4 bg-green-100 rounded-xl sm:hidden">
                                                <div class="font-bold text-md text-gray-800 leading-none">
                                                    Escríbenos si tienes algún problema.
                                                </div>
                                                <div class="mt-5">
                                                    <a target="_blank"
                                                        href="https://wa.me/573234030976?text=Hola%2C%20me%20comunico%20por%20la%20plataforma%20Amor%20Animal."
                                                        type="button"
                                                        class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                                                        whatsapp
                                                    </a>
                                                </div>
                                            </div>
                                            <div
                                                class=" dashboard-6 p-4 bg-white shadow-sm border rounded text-gray-800 space-y-2 w-full dashboard-7">
                                                <div class="flex justify-between">
                                                    <div class="text-gray-400 text-xs">PandasCode</div>
                                                </div>
                                                <a href="javascript:void(0)" class="text-slate-500 font-bold">Tiempo
                                                    de
                                                    licencia</a>
                                                <div class="text-sm text-gray-400">
                                                    Su licencia de prueba es válida por <strong>tres meses</strong>. Una
                                                    vez finalizada,
                                                    la plataforma entrará en un <strong>proceso de corrección de
                                                        errores</strong>. Si desea
                                                    continuar utilizando el servicio, por favor <strong>comuníquese con
                                                        el
                                                        equipo de soporte </strong> para extender su licencia de prueba.

                                                    <br>
                                                    <strong> Fecha vencimiento de licencia
                                                        {{ $this->limiteLicencia }}</strong>

                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
