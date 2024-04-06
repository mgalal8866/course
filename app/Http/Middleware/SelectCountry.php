<?php

namespace App\Http\Middleware;

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

            $request->session()->put('country', $country);
        }else{
            $request->session()->put('country', 'EG');
        }
        // $country = $request->session()->get('country');

        return $next($request);
    }
}
