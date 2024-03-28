<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'course_gender'      => $this->course_gender == 1 ? 'طلاب' : 'طالبات', //الصورة
            'course_currency'   => 'ر.س', //عملة الدفع
            'course_price'      => $this->price ?? '', //السعر
            'course_price_include'      => $this->pricewith == 1 ? 'شامل كتاب الدورة' : 'غير شامل كتاب الدورة',
            'file_scheduleurl'     => $this->scheduleurl ?? 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', //كتاب الدورة
            'duration'          => $this->duration ?? '', //مده الدورة
            'validity'          => $this->validity ?? '', //صلاحية الدورة
            'short_description' => $this->short_description ?? '', //نبذه مختصرة
            'features'          => $this->features ?? '<p style="text-align:center"><span style="color:#e74c3c"><span style="font-size:14px"><strong>نبذه مختصرة بتنسيق</strong></span></span></p>' ?? '', // مييزات الدورة
            'description'       => $this->description ?? '',
            'sections_guide'    => $this->sections_guide ?? '',
            'start_date'        => $this->start_date ?? '',
            'end_date'          => $this->end_date ?? '',
            'time'              => $this->time ?? '',
            'conditions'        => $this->conditions ?? '',
            'free_tatorul'      => $this->free_tatorul ?? '',
            'how_start'         => $this->how_start ?? '',
            'target'            => $this->target ?? '',
            'next_cource'       => $this->next_cource ?? '',
            'inputnum'          => $this->inputnum ?? '',
            'price_print'       => $this->price_print ?? '',
            'max_drainees'      => $this->max_drainees ?? '',
            'answer_the_question'    => $this->answer_the_question ?? '',
            'calc_rate'         => $this->calc_rateurl ?? '',
            'telegram_gorup'    => $this->telegramgrup ?? '',
            'telegram_channel'  => $this->telegram ?? '',
            'created_at'        => $this->created_at->format('d/m/Y'),
            'course_subscripe'  => 'true',
            ];
    }
}
