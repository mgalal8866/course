<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        Carbon::setLocale('ar');
        return [
            'id'          => $this->id,
            'title'       => $this->title??'',
            'body'        => $this->body??'',
            'type'        => $this->type??'',
            'redirect_id' => $this->redirect_id??'',
            'is_read'     => $this->is_read??'',
            'date'        => $this->created_at->diffForHumans()??'',
        ];
    }
}
