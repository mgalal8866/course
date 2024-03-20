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
            'course' => $this['data'][0]['childrens'][0]['courses'][0]?new CourseResource( $this['data'][0]['childrens'][0]['courses'][0]):[],
            'course_files'      => [
                'file_supplementary' => $this['data'][0]['childrens'][0]['courses'][0]['file_supplementary'] ?? '',
                'file_aggregates'    => $this['data'][0]['childrens'][0]['courses'][0]['file_aggregates'] ?? '',
                'file_explanatory'   => $this['data'][0]['childrens'][0]['courses'][0]['file_explanatory'] ?? '',
                'file_work'          => $this['data'][0]['childrens'][0]['courses'][0]['file_work'] ?? '',
                'file_test'          => $this['data'][0]['childrens'][0]['courses'][0]['file_test'] ?? '',
                'file_free'          => $this['data'][0]['childrens'][0]['courses'][0]['file_free'] ?? ''
            ],
            'stages' => ParentStagesResource::collection( $this['data']),
            'comments' => $this['data'][0]['childrens'][0]['courses'][0]['comments']?CommentsResource::collection( $this['data'][0]['childrens'][0]['courses'][0]['comments']):[],
            'triners' => $this['data'][0]['childrens'][0]['courses'][0]['coursetrainers']?TrainerResource::collection( $this['data'][0]['childrens'][0]['courses'][0]['coursetrainers']):[],

        ];
    }
}
