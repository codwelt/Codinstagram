<?php
namespace Codwelt\codinstagram\providers;
use Illuminate\Support\ServiceProvider;
class CodinstagramServiceProviders extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../routes.php';
        $this->publishes([__DIR__.'/../public' => public_path('codinstagram'),], 'public');
        $this->publishes([__DIR__.'/../views/base/' => resource_path('views/codinstagram/'),], 'views');
        $this->publishes([__DIR__.'/../seeders/' => database_path('/seeds'),], 'seeder');
        $this->loadViewsFrom(__DIR__.'/../views/', 'codinstagram');
        $this->loadMigrationsFrom(__DIR__.'/../migrations/');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
