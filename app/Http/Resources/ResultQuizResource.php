<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultQuizResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'                => $this->id??'',
            'mark'              => '( ' .( isset($this->id)? $this->quiz_result_details->sum('marks'):'0') . ' / ' . (isset($this->id)?$this->quiz->total_marks:'0') . ' )',
            'Result'            => '( ' . (isset($this->id)? $this->quiz->question->count():'0') . ' / ' . (isset($this->id) ? $this->quiz_result_details->count() : '0') . ' )' ,
            'history'           => $this->history??'',
        ];
    }
}
