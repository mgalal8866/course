<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeHeaderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            [
                'page' => 'home',
                'url' => '/homeheader',
                'hasdropdwon' => false,
            ], [
                'page' => __('tran.courses'),
                'url' => '',
                'hasdropdwon' => true,
                'dropdown' => CategoryCourseResource::collection($this['category'])
            ]
            ,[
                'page' => __('tran.freecourse'),
                'url' => '',
                'hasdropdwon' => true,
                'dropdown' => CategoryFreeCourseResource::collection($this['categoryfree'])
            ]
            ,[
                'page' => 'اختبارات تحديد المستوي',
                'url' => '',
                'hasdropdwon' => true,
                'dropdown' => []
            ]
            ,[
                'page' => 'المسابقات',
                'url' => '/contests',
                'hasdropdwon' => false,
                'dropdown' => []

            ]
            ,[
                'page' => 'انضم لفريق المسوقين',
                'url' => '/affiliate',
                'hasdropdwon' => false,
                'dropdown' => []

            ]


        ];
    }
}
