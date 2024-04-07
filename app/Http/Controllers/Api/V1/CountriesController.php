<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Country;
use App\Models\CategoryBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use Browser;
use Stevebauman\Location\Facades\Location;
use App\Http\Resources\CategoryBookResource;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;

class CountriesController extends Controller
{


    function get_test(Request $request)
    {
        return [
            'browser' => !empty(Browser::browserName()) ? Browser::browserName() : $request->browser??'',
            'os' => !empty(Browser::platformName()) ? Browser::platformName() : $request->os??'',
            'location' => Location::get($request->ip())
        ];
    }
    function get_countries(Request $request)
    {
        $data = Country::whereActive('1')->get();
        return Resp(CountryResource::collection($data), 'success');
    }
}
