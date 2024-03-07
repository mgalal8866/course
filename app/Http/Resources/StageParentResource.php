<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StageParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'parent_stage_id'        => $this->id,
            'parent_stage_name'      => $this->name,
            'parent_stage_lessons'   => LessonResource::collection($this->lessons)
            // 'parent_stage_lessons'   => StageResource::collection($this->stages)
        ];
    }
}
