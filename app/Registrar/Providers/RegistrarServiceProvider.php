<?php
namespace App\Registrar\Providers;

use Illuminate\Support\ServiceProvider;

class RegistrarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind any interface to concrete classes here
    }

    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        // Load routes
        $this->loadRoutesFrom(base_path('routes/registrar_api.php'));
        $this->loadRoutesFrom(base_path('routes/rdap.php'));
    }
}
