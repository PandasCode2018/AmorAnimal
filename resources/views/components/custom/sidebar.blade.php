<aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

    <ul class="list-reset flex flex-col">

        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ route('dashboard') }}"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fa-solid fa-chart-line mr-2"></i>
                Dashboard
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ route('users.index') }}"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-user mr-2"></i>
                Usuario
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="#"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-user-tag mr-2"></i>
                Roles
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="#"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-users mr-2"></i>
                Responsable
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="#"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-paw mr-2"></i>
                Animales
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="#"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fa-solid fa-stethoscope mr-2"></i>
                Consulta
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ route('audits.index') }}"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-clipboard-check mr-2"></i> Auditoría
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="#"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-file-alt mr-2"></i>
                Reportes
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="#"
                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-book mr-2"></i>
                Manuales
            </a>
        </li>
    </ul>

</aside>
