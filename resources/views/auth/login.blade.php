<x-guest-layout>
    <div
        class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gradient-to-b py-10 from-[#584a76] to-[#36afe4]">
        <div class="flex shadow-2xl">
            <div class="flex flex-wrap content-center justify-center rounded-l-md bg-white"
                style="width: 24rem; height: 32rem;">
                <div class="w-72">
                    <h1 class="text-xl font-semibold">Bienvenido de nuevo</h1>
                    <small class="text-gray-400">AmorAnimal</small>

                    <form class="mt-4" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2 block text-xs font-semibold">Correo</label>
                            <input :value="old('email')" required type="email" name="email" id="email"
                                autocomplete="username" type="email" placeholder="amoranima24@gmail.com"
                                class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                        </div>
                        <div class="mb-3">
                            <label class="mb-2 block text-xs font-semibold">contrseña</label>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required placeholder="*****"
                                class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                        </div>

                        <div class="mb-3 flex flex-wrap content-center">
                            <label for="remember_me" class="mr-auto text-xs font-semibold">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                            </label>
                            <a href="{{ route('public.company.form') }}"
                                class="text-xs font-semibold text-purple-700">Registrate</a>
                        </div>



                        <div class="mb-3">
                            <button type="submit"
                                class="mb-1.5 block w-full text-center text-white bg-[#8066b6] hover:bg-purple-900 px-2 py-1.5 rounded-md">Ingresar</button>
                        </div>

                        <x-validation-errors class="mb-4" />

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="sm:flex flex-wrap content-center justify-center rounded-r-md hidden"
                style="width: 24rem; height: 32rem;">
                <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md"
                    src="{{ asset('img_sistema/login.jpeg') }}">
            </div>
        </div>
    </div>
</x-guest-layout>
