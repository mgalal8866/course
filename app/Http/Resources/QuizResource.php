<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'                => $this['question']->id,
            'name'              => $this['question']->name??'',
            'image'             => $this['question']->urlimage??'',
            'description'       => $this['question']->description??'',
            'time'              => $this['question']->time??'',
            'questions_count'   =>number_format($this['question']->question_count) ??'',
            'questions'         =>QuizQuestionResource::collection($this['question']->question) ??'',
            'results'           => new ResultQuizResource( $this['result']),
        ];
    }
}
