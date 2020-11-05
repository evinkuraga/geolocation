<?php

namespace Evinkuraga\GeoLocation\Contracts\Services;

interface GeoLocation
{

    /**
     * Get IP information
     *
     * @param $ip
     * @param $precision
     * @return Evinkuraga\GeoLocation\Services\IpLocation
     */
    public function get($ip, $precision = 'city');

    /**
     * Get IP information with City Precision
     *
     * @param $ip
     * @return IpLocation
     */
    public function getCity($ip);

    /**
     * Get IP information with Country Precision
     *
     * @param $ip
     * @return IpLocation
     */
    public function getCountry($ip);

}
