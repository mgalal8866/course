<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name'         => $this->first_name??'' . ' ' . $this->last_name??'' ,
            'phone'        => $this->phone??''  ,
            'email'        => $this->email??''  ,
            'gender'       => $this->gender ==1? __('tran.male'):  __('tran.female') ,
            'point'        => $this->point??'0'  ,
            'wallet'       => $this->wallet??'0' ,
            'country'      => new CountryResource($this->country)??'' ,
            'phone_parent' => $this->phone_parent??''  ,
            'email_parent' => $this->email_parent??'' ,
            'notifiction'  => $this->notifiction??'' ,
            'token'        => $this->token ,

        ];
    }
}
