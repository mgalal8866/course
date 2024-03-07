<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // $uniqueBrands = $this->collection;

        // ->filter(function ($parent_id) {
        //         return !is_null($parent_id);
        //     });


            return[
            // 'parent_stage_id'      => $this->_parent->id,
            // 'parent_stage_name'      => $this->_parent->name,
            // 'stage'=>[
            'parent_id'      => $this->parent_id,
            'stage_id'        => $this->id,
            'stage_name'      => $this->name,
            'stage_lessons' => LessonResource::collection($this->lessons)
        // ]
    ];
    }
}
