<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesCategoryEnrolledResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'category_id'         => $this->id,
            'category_name'       => $this->name,
            'course' => CoursesEnrolledResource::collection($this->courses)
        ];
    }
}
