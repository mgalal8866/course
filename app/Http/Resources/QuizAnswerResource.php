<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizAnswerResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'answer_id' => $this->id,
            'name'      => $this->answer??'',
        ];
    }
}
