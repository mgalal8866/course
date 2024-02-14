<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

                'id'     => $this->id??'',
                'image'  => $this->imageurl??'',
                'redirect_to'  => $this->course_id??'',
                'is_course'    => $this->is_course??'',



        ];
    }
}
