@section('subhead')
    <title>Inicio - {{ config('app.name') }}</title>
@endsection
<div class=" mx-2">
    <div class="mb-2  w-full">
        <div class="mt-3 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-12 2xl:col-span-12 shadow-2xl">
                <div class="p-2 w-full">
                    <div class="flex-auto block p-3">
                        <div class="overflow-x-auto lg:overflow-visible">
                            <div class="bg-white rounded-3xl p-8 mb-5">
                                <h1 class="text-3xl font-bold mb-7">¡Bienvenidos a AmorAnimal!</h1>
                                <div class="items-center justify-between hidden sm:flex">
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

                                <hr class="my-10">

                                <div class="grid grid-cols-2 gap-x-20">
                                    <div>
                                        <h2 class="text-2xl font-bold mb-4"> {{ Auth::user()->company->name_company }}
                                        </h2>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="col-span-2">
                                                <div class="p-4 bg-green-100 rounded-xl">
                                                    <div class="font-bold text-md text-gray-800 leading-none">
                                                        Buenos dias, <br>{{ Auth::user()->name }}</div>
                                                    <div class="mt-5">
                                                        <button type="button"
                                                            class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                                                            Escríbenos si tienes algún problema.
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                                <div class="font-bold text-2xl leading-none pb-3">
                                                    {{ $this->totalAnimales }}
                                                </div>
                                                <a href="{{ route('animal.index') }}"
                                                    class="py-2 px-3 mt-2 rounded-xl bg-white text-gray-800 hover:text-yellow-400 text-sm font-semibold transition">
                                                    Total de animales</a>
                                            </div>
                                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                                <div class="font-bold text-2xl leading-none pb-3">
                                                    {{ $this->totalConsultasHoy }}</div>
                                                <a href="{{ route('consultation.index') }}"
                                                    class="py-2 px-3 mt-2 rounded-xl bg-white text-gray-800 hover:text-yellow-400 text-sm font-semibold transitio">
                                                    Total de consultas para hoy</a>
                                            </div>
                                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                                <div class="font-bold text-2xl leading-none pb-3">
                                                    {{ $this->totalConsultas }}
                                                </div>
                                                <a href="{{ route('consultation.index') }}"
                                                    class="py-2 px-3 mt-2 rounded-xl bg-white text-gray-800 hover:text-yellow-400 text-sm font-semibold transitio">
                                                    Total de consultas</a>
                                            </div>
                                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                                <div class="font-bold text-2xl leading-none pb-3">
                                                    {{ $this->totalResponsables }}
                                                </div>
                                                <a href="{{ route('responsible.index') }}"
                                                    class="py-2 px-3 mt-2 rounded-xl bg-white text-gray-800 hover:text-yellow-400 text-sm font-semibold transition">
                                                    Total de Responsables</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-t pt-2 mt-2">
                                        <h2 class="text-2xl font-bold mb-4">Información del sistema</h2>

                                        <div class="space-y-4">
                                            <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                                <div class="text-gray-400 text-xs">PandasCode</div>
                                                <a href="#"
                                                    class="font-bold hover:text-yellow-800 hover:underline">Fecha
                                                    vecimiento de licencia</a>
                                                <div class="text-sm text-gray-600">
                                                    {{ $this->limiteLicencia }}
                                                </div>
                                            </div>
                                            <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                                <div class="flex justify-between">
                                                    <div class="text-gray-400 text-xs">PandasCode</div>
                                                </div>
                                                <a href="javascript:void(0)"
                                                    class="font-bold hover:text-yellow-800 hover:underline">Manules</a>
                                                <div class="text-sm text-gray-600">

                                                </div>
                                            </div>
                                            <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                                <div class="flex justify-between">
                                                    <div class="text-gray-400 text-xs">PandasCode</div>
                                                </div>
                                                <a href="{{ route('Suggestions.index') }}"
                                                    class="font-bold hover:text-yellow-800 hover:underline">Sugerencias</a>
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
