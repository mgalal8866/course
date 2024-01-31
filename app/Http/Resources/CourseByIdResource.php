<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseByIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'course_id'        => $this->id,
            'course_name'      => $this->name,
            'course_subscripe'  =>'false',
            'created_at' => $this->created_at,
            'course_stages'    => StageResource::collection($this->stages ) ,
        ];
    }
}
