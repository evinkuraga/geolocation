# Geolocation [![Latest Stable Version](https://poser.pugx.org/evinkuraga/geolocation/version)](https://packagist.org/packages/evinkuraga/geolocation) [![Total Downloads](https://poser.pugx.org/evinkuraga/geolocation/downloads)](https://packagist.org/packages/evinkuraga/geolocation) [![Latest Unstable Version](https://poser.pugx.org/evinkuraga/geolocation/v/unstable)](https://packagist.org/packages/evinkuraga/geolocation) [![License](https://poser.pugx.org/evinkuraga/geolocation/license.svg)](https://packagist.org/packages/evinkuraga/geolocation) [![Build](https://travis-ci.org/evinkuraga/geolocation.svg?branch=master)](https://travis-ci.org/evinkuraga/geolocation) [![Coverage Status](https://coveralls.io/repos/github/evinkuraga/geolocation/badge.svg?branch=master)](https://coveralls.io/github/evinkuraga/geolocation?branch=master)

A IP Info DB integration for Laravel

# Note
This was forked from evinkuraga/geolocation just so I could edit the composer file to accept guzzle ^7.0 which is required to work with later verisons of laravel 6.0. I've noticed the usage of Guzzle seems minimal, so I will either eventually tweak it to work with guzzle 7, or just add it in the composer and see what happens.

# Installation

This package requires PHP 5.6+, and includes a Laravel 5 Service Provider and Facade.

To install through composer include the package in your `composer.json`.

    "evinkuraga/geolocation": "^2.0"

Run `composer install` or `composer update` to download the dependencies or you can run `composer require evinkuraga/geolocation`.

## Refresh Autoloader

At this point some users may need to run the command `composer dump-autoload`. Alternatively, you can run `php artisan optimize`
which should include the dump-autoload command.

## Laravel 5 Integration

To use the package with Laravel 5 firstly add the GeoLocation service provider to the list of service providers 
in `app/config/app.php`.

    'providers' => [

      Evinkuraga\GeoLocation\GeoLocationServiceProvider::class
              
    ];
    
Add the `GeoLocation` facade to your aliases array.

    'aliases' => [

      'GeoLocation' => Evinkuraga\GeoLocation\Facades\GeoLocation::class,
      
    ];
    
Publish the config and migration files using 
`php artisan vendor:publish --provider="Evinkuraga\GeoLocation\GeoLocationServiceProvider"`
    
# Configuration File

Once you have published the config files, you will find a `geolocation.php` file in the `config` folder. You should 
look through these settings and update these where necessary. 

# Env

You will need to add the following to your `.env` file and update these with your own settings

    GEOLOCATION_API_KEY=<key>
    GEOLOCATION_CACHE=<duration_in_minutes>

# Get your GeoLocation API Key

Before using this package you must get an API Key from IP Info DB. Please access http://ipinfodb.com/register.php and after registering and confirming your email address your api key will be show. Please copy and set to your `.env` file on `GEOLOCATION_API_KEY` option.

# Example Usage

    use Evinkuraga\GeoLocation\Contracts\Services\GeoLocation;
    use Illuminate\Http\Request;
    
    public function index(GeoLocation $geo, Request $request) 
    {
        $ipLocation = $geo->getCity($request->ip());
        
        // if you do $geo->get($request->ip()), the default precision is now city
    
        // $ipLocation is an IpLocation Object
        
        echo $ipLocation->ipAddress; // e.g. 127.0.0.1
        
        echo $ipLocation->getAddressString(); // e.g. London, United Kingdom
        
        // the object has a toJson() and toArray() method on it 
        // so you can die and dump an array.
        dd($ipLocation->toArray()); 

    }
    
# Methods on IpLocation

    $ipLocation->getStatusCode(); // returns status code of request (e.g. 200)
    $ipLocation->getStatusMessage(); // returns any status message to go with code
    $ipLocation->getIpAddress(); // the geolocation IP requested
    $ipLocation->getCountryCode(); // country code of the IP e.g. GB
    $ipLocation->getCountryName(); // country name of the IP e.g. United Kingdom
    $ipLocation->getRegionName(); // region name of the IP e.g. England
    $ipLocation->getCityName(); // city name of the IP e.g. London
    $ipLocation->getZipCode(); // postcode of the IP e.g. SE01 1AA
    $ipLocation->getPostCode(); // postcode of the IP e.g. SE01 1AA
    $ipLocation->getLatitude(); // latitude of the IP e.g. 53.4030
    $ipLocation->getLongitude(); // longitude of the IP e.g. -1.201
    $ipLocation->getTimeZone(); // timezone of the IP e.g.
    $ipLocation->getAddressString(); // gets the city, region and country as a string
    $ipLocation->toArray(); // returns object as an array
    $ipLocation->toJson(); // returns object as a json object
