<?php

namespace App\Http\Resources\Caluc;

use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentStagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'quiz' => StagesResource::collection($this->childrens),
        ];
    }
}
