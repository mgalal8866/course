<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'                => $this->id,
            'name'              => $this->name??'',
            'image'             => $this->urlimage??'',
            'description'       => $this->description??'',
            'time'              => $this->time??'',
            'questions_count'   =>number_format($this->question_count) ??'',
            'questions'         =>QuizQuestionResource::collection($this->question) ??'',
        ];
    }
}
