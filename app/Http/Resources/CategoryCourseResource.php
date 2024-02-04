<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCourseResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'courses'=> $this->courses_count ,
            'image'  => $this->imageurl,
            // 'url'    => '/getcourse/'.$this->id,
        ];
    }
}
