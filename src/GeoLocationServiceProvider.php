<?php
namespace Evinkuraga\GeoLocation;

use Illuminate\Support\ServiceProvider;
use Evinkuraga\GeoLocation\Services\GeoLocation;

class GeoLocationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application events.
     *
     * @return void
     * @codeCoverageIgnore
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/../config/geolocation.php' => config_path('geolocation.php')
        ]);
        $this->mergeConfigFrom(__DIR__ . '/../config/geolocation.php', 'geolocation');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('evinkuraga.geolocation', function ($app) {
            return new GeoLocation();
        });

        $this->app->alias('evinkuraga.geolocation', 'Evinkuraga\GeoLocation\Contracts\Services\GeoLocation');
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['evinkuraga.geolocation', 'Evinkuraga\GeoLocation\Contracts\Services\GeoLocation'];
    }
}
