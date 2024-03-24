<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CalculatingProgresRateResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

                'stage' => $this
        ];
    }
}
