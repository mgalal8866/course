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
            'status'            => $this->course->status??'1',
            'course_subscripe' => 'true',
        ];
    }
}
