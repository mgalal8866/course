<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'             => $this->id,
            'type'           => $this->type,
            'image'          => $this->image,
            'name'           => $this->name,
            'account_name'   => $this->account_name,
            'account_number' => $this->account_number,
            'iban_number'    => $this->iban_number,
            
            'api_key'        => $this->api_key??'',
            'secret_key'     => $this->secret_key??'',
            // 'active'         => $this->active??'',
        ];
    }
}
