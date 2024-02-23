<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizQuestionResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'question_id'     => $this->id,
            'question_body'   => $this->question??'',
            'answers'         => QuizAnswerResource::collection($this->answer),
        ];
    }
}
