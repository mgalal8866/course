<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $otherDate = Carbon::now();
        $nowDate = Carbon::now();

        $result = $nowDate->gt($otherDate);
        return [
            'lesson_id'        => $this->id,
            'lesson_name'      => $this->name??'',
            // 'lesson_link'      => ( $this->pivot->publish_at != null ) ? $nowDate->gt($otherDate) : $this->link_video??'',
            'lesson_link'      => ( $this->pivot->publish_at != null ) ? (($nowDate->gt($this->pivot->publish_at))? $this->link_video : '') :'',
            'lesson_publish_at'=>  ( $this->pivot->publish_at != null ) ? (($nowDate->gt($this->pivot->publish_at))? $this->pivot->publish_at :    Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->publish_at)->format('d/m/Y') ) . '  -  ' . 'تاريخ العرض '  :'',
            'is_lesson'        => number_format($this->is_lesson)??'',
        ];
    }
}
