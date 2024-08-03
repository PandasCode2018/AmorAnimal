<header class="bg-nav h-16">
    <div class="flex justify-between items-center h-full px-4">
        <!-- Sección del Logo y el Menú -->
        <div class="p-1 inline-flex items-center">
            <!-- Icono de Menú -->
            <i class="fas fa-bars text-white text-2xl pr-2 cursor-pointer" onclick="sidebarToggle()"></i>
            <!-- Logo -->
            <h1 class="text-white text-2xl font-bold">Logo</h1>
        </div>

        <!-- Sección del Perfil -->
        <div class="p-1 flex items-center space-x-4">
            <!-- Imagen de Perfil -->
            <img onclick="profileToggle()" class="inline-block h-10 w-10 rounded-full cursor-pointer"
                src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="Profile Picture">

            <!-- Nombre de Usuario -->
            <a href="#" onclick="profileToggle()"
                class="text-white text-lg no-underline hidden md:block lg:block">Adam Wathan</a>

            <!-- Dropdown del Perfil -->
            <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute mt-12 right-0">
                <ul class="list-reset">
                    <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My
                            account</a></li>
                    <li><a href="#"
                            class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a>
                    </li>
                    <li>
                        <hr class="border-t mx-2 border-grey-light">
                    </li>
                    <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
