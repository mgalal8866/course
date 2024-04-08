<?php

namespace App\Http\Middleware;

use App\Models\Country;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class SelectCountry
{

    public function handle($request, Closure $next)
    {
        $country = $request->header('country');
        if ($country) {

            $request->headers->set('country' ,$country);
        } else {

            $s =  json_decode(json_encode(Location::get($request->ip())), true);
            $c = Country::where('iso2', $s['countryCode']??'EG')->first();
            if($c->id ){
                $request->headers->set('country' ,$c->id);
            }
        }
        return $next($request);
    }
}
