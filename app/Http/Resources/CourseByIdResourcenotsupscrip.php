<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseByIdResourcenotsupscrip extends JsonResource
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
            'course_name'       => $this->name,
            'course_image'      => $this->imageurl ?? '',
            'course_currency'   => 'ر.س',
            'course_price'      => $this->price ?? '',//كاتب
            'course_price_include'      => 'شامل كتاب الدورة',//كاتب

            'short_description' => $this->short_description ?? '',
            'schedule'          => $this->schedule ?? '',
            'description'       => $this->description ?? '',
            'features'          => 'features-features-features-features-features' ?? '',
            'start_date'        => $this->start_date ?? '',
            'end_date'          => $this->end_date ?? '',
            'duration'          => $this->duration_course ?? '',
            'conditions'        => $this->conditions ?? '',
            'validity'          => $this->validity ?? '',
            'free_tutorial'     => $this->file_free ?? '',
            'free_file'         => $this->file_free ?? '',
            'max_drainees'      => $this->max_drainees ?? '',
            'created_at'        => $this->created_at->format('d/m/Y'),
            'course_subscripe' => 'false',

        ];
    }
}
