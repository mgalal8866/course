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
            'course_name'       => $this->name, //اسم الدورة
            'course_image'      => $this->imageurl ?? '', //الصورة
            'course_currency'   => 'ر.س', //عملة الدفع
            'course_price'      => $this->price ?? '',//السعر
            'course_price_include'      => $this->pricewith == 1 ? 'شامل كتاب الدورة' : 'غير شامل كتاب الدورة',
            'file_schedule'     => $this->schedule ?? 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', //كتاب الدورة
            'duration'          => $this->duration ?? '', //مده الدورة
            'validity'          => $this->validity ?? '', //صلاحية الدورة
            'short_description' => $this->short_description ?? '', //نبذه مختصرة
            'features'          => $this->features ?? '<p style="text-align:center"><span style="color:#e74c3c"><span style="font-size:14px"><strong>نبذه مختصرة بتنسيق</strong></span></span></p>' ?? '', // مييزات الدورة
            'conditions'        => $this->conditions ?? '', //شروط واحكام
            'free_tatorul'      => $this->free_tatorul ?? '',
            // 'free_file'         => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'?? '',
            'free_file'          => $this->file_free ?? '',
            'start_date'        => $this->start_date ?? '', //تاريخ بدايه الدورة
            'end_date'          => $this->end_date ?? '', //تايخ انتهاء الدورة
            'max_drainees'      => $this->max_drainees ?? '', //عدد المقاعد
            'comments'      => CommentsResource::collection($this->comments->where('active',1)),

        ];
    }
}
