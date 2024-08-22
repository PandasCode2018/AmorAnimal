<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        # Orden de estados de los estado de las conultas medicas
        define('CANCELADA', 0);
        define('ESPERA', 1);
        define('ATENCION', 2);
        define('FINALIZADA', 3);

        #Globales
        define('ACTIVO', 1);
        define('INACTIVO', 0);
        define('YMD', 'Y-m-d');
    }
}
