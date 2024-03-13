<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultQuizResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'                => $this->id,
            'mark'              => '( ' . $this->quiz_result_details->sum('marks') . ' / ' . $this->quiz->total_marks . ' )',
            'Result'            => '( ' . $this->quiz->question->count() . ' / ' . $this->quiz_result_details->count() . ' )' ,
            'history'           => $this->history,
        ];
    }
}
