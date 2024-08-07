<?php

namespace App\Http\Resources\Caluc;

use Illuminate\Http\Request;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionCourseResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'course' => isset($this['data'][0]['childrens'][0]['courses'][0]) ? new CourseResource($this['data'][0]['childrens'][0]['courses'][0]) : [],
            'course_files'      => [
                'file_supplementary' =>  isset($this['data'][0]['childrens'][0]['courses'][0]['file_supplementary']) ? $this['data'][0]['childrens'][0]['courses'][0]['file_supplementaryurl'] : '',
                'file_aggregates'    =>  isset($this['data'][0]['childrens'][0]['courses'][0]['file_aggregates']) ? $this['data'][0]['childrens'][0]['courses'][0]['file_aggregatesurl'] : '',
                'file_explanatory'   =>  isset($this['data'][0]['childrens'][0]['courses'][0]['file_explanatory']) ? $this['data'][0]['childrens'][0]['courses'][0]['file_explanatoryurl'] : '',
                'file_work'          =>  isset($this['data'][0]['childrens'][0]['courses'][0]['file_work']) ? $this['data'][0]['childrens'][0]['courses'][0]['file_workurl'] : '',
                'file_test'          =>  isset($this['data'][0]['childrens'][0]['courses'][0]['file_test']) ? $this['data'][0]['childrens'][0]['courses'][0]['file_testurl'] : '',
                'file_free'          =>  isset($this['data'][0]['childrens'][0]['courses'][0]['file_free']) ? $this['data'][0]['childrens'][0]['courses'][0]['file_freeurl'] : ''
            ],
            'stages' => ParentStagesResource::collection($this['data']),
            'comments' =>  isset($this['data'][0]['childrens'][0]['courses'][0]['comments']) ? CommentsResource::collection($this['data'][0]['childrens'][0]['courses'][0]['comments']) : [],
            'triners' =>   isset($this['data'][0]['childrens'][0]['courses'][0]) ? TrainerResource::collection($this['data'][0]['childrens'][0]['courses'][0]['coursetrainers']) : [],

        ];
    }
}
