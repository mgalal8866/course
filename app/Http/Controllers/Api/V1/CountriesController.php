<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Country;
use App\Models\CategoryBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use Stevebauman\Location\Facades\Location;
use App\Http\Resources\CategoryBookResource;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;

class CountriesController extends Controller
{


    function get_test(Request $request)
    {
        return Location::get($request->ip());
    }
    function get_countries()
    {
        // Country::create([
        //     'name'=>'Saudi Arabia',
        //     'phonecode'=>'966',
        //     'currency'=>['ar'=>'ريال سعودى','en'=>'SAR'],
        //     'iso2'=>'SA',
        //     'iso3'=>'SAU',
        // ]);
        // Country::create([
        //     'name'=>'Egypt',
        //     'phonecode'=>'20',
        //     'currency'=>['ar'=>'جنية مصرى','en'=>'EGP'],
        //     'iso2'=>'EG',
        //     'iso3'=>'EGY',
        // ]);
        $data= Country::whereActive('1')->get();
          return Resp(CountryResource::collection($data),'success');
    }
}
