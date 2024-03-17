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

        // $uniqueBrands = $this->collection->pluck('stages')->filter(function ($brand) {
        //     return !is_null($brand);
        // })->unique();
        // dd($uniqueBrands??'');
        return [
            'course_id'         => $this->id,
            'course_name'       => $this->name, //اسم الدورة
            'course_image'      => $this->imageurl ?? '', //الصورة
            'course_gender'      => $this->course_gender == 1 ? 'طلاب' : 'طالبات', //الصورة
            'course_currency'   => 'ر.س', //عملة الدفع
            'course_price'      => $this->price ?? '', //السعر
            'course_price_include'      => $this->pricewith == 1 ? 'شامل كتاب الدورة' : 'غير شامل كتاب الدورة',
            'file_schedule'     => $this->schedule ?? 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', //كتاب الدورة
            'duration'          => $this->duration ?? '', //مده الدورة
            'validity'          => $this->validity ?? '', //صلاحية الدورة
            'short_description' => $this->short_description ?? '', //نبذه مختصرة
            'features'          => $this->features ?? '<p style="text-align:center"><span style="color:#e74c3c"><span style="font-size:14px"><strong>نبذه مختصرة بتنسيق</strong></span></span></p>' ?? '', // مييزات الدورة
            'description'       => $this->description ?? '',
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
            'telegram_gorup'    => $this->telegramgrup ?? '',
            'telegram_channel'  => $this->telegram ?? '',
            'created_at'        => $this->created_at->format('d/m/Y'),
            'course_files'      => [
                'file_supplementary' => $this->file_supplementary ?? '',
                'file_aggregates'    => $this->file_aggregates ?? '',
                'file_explanatory'   => $this->file_explanatory ?? '',
                'file_work'          => $this->file_work ?? '',
                'file_test'          => $this->file_test ?? '',
                'file_free'          => $this->file_free ?? ''
            ],
            'course_trainer'    => TrainerResource::collection($this->coursetrainers),
            // 'course_parent_stages'     =>      $this,
            'course_stages'     => StageResource::collection($this->stages),
            'comments'          => CommentsResource::collection($this->comments->where('active', 1)),
            'course_subscripe'  => 'true',
        ];
    }
}
