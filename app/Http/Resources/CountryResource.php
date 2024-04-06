<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'country_id'        => $this->id ,
            'country_name'      => $this->name ,
            'country_phonecode' => $this->phonecode ,
            'country_code'      => $this->iso2 ,
            'is_default'        => $this->iso2  == $request->session()->get('country') ?'1':'0',
            // 'country_code3'     => $this->iso3 ,
            'country_flag'      => asset('asset/flag/country-') .Str::lower($this->iso2).'.svg' ,
            'country_currency'  => $this->currency[Lang::locale()] ,
        ];
    }
}
