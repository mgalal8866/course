<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'          => $this->id,
            'title'       => $this->title??'',
            'body'        => $this->body??'',
            'user_id'     => $this->user_id??'',
            'type'        => $this->type??'',
            'redirect_id' => $this->redirect_id??'',
            'is_read'     => $this->is_read??'',
            'date'        => $this->created_at??'',
        ];
    }
}
