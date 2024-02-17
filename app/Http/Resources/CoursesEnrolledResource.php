<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesEnrolledResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'course_id'         => $this->course_id,
            'course_name'       => $this->course->name, //اسم الدورة
            'course_subscripe' => 'true',
        ];
    }
}
