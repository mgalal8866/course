<?php

namespace App\Http\Resources;

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
            'country_code2'     => $this->iso2 ,
            'country_code3'     => $this->iso3 ,
            'country_currency'  => $this->currency[Lang::locale()] ,
        ];
    }
}
