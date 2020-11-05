<?php
namespace Evinkuraga\GeoLocation\Tests;

use Illuminate\Container\Container;
use Evinkuraga\GeoLocation\GeoLocationServiceProvider;
use PHPUnit\Framework\TestCase;

class GeoLocationServiceTest extends TestCase
{
    protected $app;

    protected $serviceProvider;

    public function setup()
    {
        $this->app = new Container();

        $this->app['config'] = ['geolocation' => $this->getConfig()];

        $this->serviceProvider = new GeoLocationServiceProvider($this->app);
    }

    /**
     * @test
     */
    public function provides_returns_all_of_the_provided_services()
    {
        $this->assertContains('evinkuraga.geolocation', $this->serviceProvider->provides());
        $this->assertContains('Evinkuraga\GeoLocation\Contracts\Services\GeoLocation', $this->serviceProvider->provides());
    }

    /**
     * @test
     */
    public function test_geolocation_can_be_resolved_from_the_container()
    {
        $this->serviceProvider->register();
        $this->assertInstanceOf('Evinkuraga\GeoLocation\Contracts\Services\GeoLocation', $this->app->make('Evinkuraga\GeoLocation\Contracts\Services\GeoLocation'));
        $this->assertInstanceOf('Evinkuraga\GeoLocation\Contracts\Services\GeoLocation', $this->app->make('evinkuraga.geolocation'));
    }

    protected function getConfig()
    {
        return require __DIR__ . '/../config/geolocation.php';
    }
}
