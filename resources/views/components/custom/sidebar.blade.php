<aside id="sidebar" class="bg-nav-blue w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav md:block lg:block"
    x-show="openSidebar" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90">

    <ul>
        <li class="w-full h-full py-3 px-2 border-b  border-slate-700">
            <a href="{{ route('profiles.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold capitalize">
                {{ Auth::user()->name }}
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 text-center text-white font-bold">
            {{ Auth::user()->company->name_company }}
        </li>
    </ul>
    <ul class="list-reset flex flex-col ">

        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('dashboard.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fa-solid fa-house mr-2"></i>
                Inicio
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('roles.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-user-tag mr-2"></i>
                Roles
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('users.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-user mr-2"></i>
                Usuarios
            </a>
        </li>

        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('responsible.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-users mr-2"></i>
                Responsables
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('animal.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-paw mr-2"></i>
                Animales
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('consultation.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fa-solid fa-stethoscope mr-2"></i>
                Consultas
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('historial.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-file-alt mr-2"></i>
                Historial de consultas
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('audits.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-clipboard-check mr-2"></i> Auditoría
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600">
            <a href="{{ route('Suggestions.index') }}"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fa-solid fa-comment mr-2"></i> Sugerencias
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600 sm:hidden">
            <!-- Escondido en pantallas pequeñas y arriba -->
            <a href="#"
                class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold">
                <i class="fas fa-book mr-2"></i>
                Soporte
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-slate-700 hover:bg-blue-600 block sm:hidden ">
            <!-- Solo se muestra en pantallas pequeñas, escondido en pantallas medianas y grandes -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a href="{{ route('logout') }}"
                    class="flex items-center font-sans font-hairline text-sm text-nav-item no-underline pl-2 text-white font-bold"
                    @click.prevent="$root.submit()">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Cerrar
                </a>
            </form>
        </li>
    </ul>
</aside>
