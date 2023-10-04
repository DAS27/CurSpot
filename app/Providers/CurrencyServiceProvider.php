<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(base_path('app/Modules/Currency/Database/Migrations'));
        $this->mergeConfigFrom(base_path('app/Modules/Currency/Config/services.php'), 'services');
        $this->mergeConfigFrom(base_path('app/Modules/Currency/Config/currency.php'), 'currency');
        // Load all route files from the directory
        foreach (glob(base_path('app/Modules/Currency/Routes/*.php')) as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
    }
}
