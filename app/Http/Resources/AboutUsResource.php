<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'  => $this->user->id??'',
            'user_name'  => $this->user->first_name??'',
            'user_image' => $this->user->image??'https://www.spruko.com/demo/valex/dist/assets/images/faces/6.jpg',
            'text'       => $this->body	??'',
        ];
    }
}
