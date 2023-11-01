<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use ipinfo\ipinfolaravel\ipinfolaravel as IpInfoLaravel;
use ipinfo\ipinfo\Details as IpInfoDetails;

class IpInfoWrapper extends IpInfoLaravel
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // IpInfo only works on the https domain you configure it for.
        // Wrapping it so I get some data for local development.

        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'testing') {
            $fakeDetails = new IpInfoDetails([
                'country' => 'US',
                'country_name' => null,
                'country_flag' => null,
                'country_code' => null,
                'country_flag_url' => null,
                'country_currency' => null,
                'continent' => null,
                'latitude' => '30.5145',
                'longitude' => '-97.6680',
                'loc' => '30.5145,-97.6680',
                'is_eu' => null,
                'ip' => '203.0.113.195',
                'hostname' => 'fake-hostname',
                'anycast' => null,
                'city' => 'Austin',
                'org' => 'Fake Org, LLC',
                'postal' => '73301',
                'region' => 'Texas',
                'timezone' => 'America/Chicago',
                'asn' => null,
                'company' => null,
                'privacy' => null,
                'abuse' => null,
                'domains' => null,
                'bogon' => null,
                'all' => null,

            ]);
            $request->merge(['ipinfo' => $fakeDetails]);
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
