<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionCourseResource extends JsonResource
{
   
    public function toArray(Request $request): array
    {
        return [
            'course' => new CourseResource( $this['data'][0]['childrens'][0]['courses'][0]),
            'stages' => ParentStagesResource::collection( $this['data']),
            'comments' => CommentsResource::collection( $this['data'][0]['childrens'][0]['courses'][0]['comments']),
            'triners' => TrainerResource::collection( $this['data'][0]['childrens'][0]['courses'][0]['coursetrainers']),

        ];
    }
}
