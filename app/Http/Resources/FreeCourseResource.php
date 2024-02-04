<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FreeCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'image'         => $this->imageurl,
            'name'          => $this->name,
            'description'   => $this->description,
            'created_at'    => $this->created_at->format('d/m/Y'),
        ];
    }
}
