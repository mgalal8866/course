<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsergradesResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'first_name'    => $this->first_name,
            'middle_name'   => $this->middle_nam ,
            'last_name'     => $this->last_name ,
            'phone'         => $this->phone ,
            'email'         => $this->email ,
            'gender'        => $this->gender ,
            'country'       =>new CountryResource($this->country) ,
        ];
    }
}
