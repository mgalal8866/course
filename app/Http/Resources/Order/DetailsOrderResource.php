<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsOrderResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'stages' => StagesResource::collection($this->childrens),
        ];
    }
}
