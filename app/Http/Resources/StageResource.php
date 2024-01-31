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
        return [
            'stage_id'        => $this->id,
            'stage_name'      => $this->name,
            'stage_lessons' => LessonResource::collection($this->lessons)
        ];
    }
}
