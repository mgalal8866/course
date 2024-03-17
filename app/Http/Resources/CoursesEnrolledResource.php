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
            'course_id'         => $this->id,
            'course_name'       => $this->name??'', //اسم الدورة
            'course_image'       => $this->imageurl??'', //اسم الدورة
            'status'            => $this->courseenrolled[0]->statu??'1',
            'course_subscripe' => 'true',
        ];
    }
}
