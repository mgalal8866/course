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


        // ->filter(function ($brand) {
        //     return !is_null($brand);
        // })
        // ->unique();
        // dd($uniqueBrands);
        return [
            // 'parent_stage_id'      => $this,
            // 'parent_stage_name'      => $this->_parent->name,
            // 'stage'=>[
            // 'parent_idi'      => $uniqueBrands,
            'parent_id'      => $this->parent_id,
            'stage_id'        => $this->id,
            'stage_name'      => $this->name,
            'stage_lessons' => LessonResource::collection($this->lessons)
            // ]
        ];
    }
}
