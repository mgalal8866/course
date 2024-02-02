<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'header' => [
                [
                    'page' => 'home',
                    'url' => '/homeheader',
                    'hasdropdwon' => false,
                ], [
                    'page' => __('tran.courses'),
                    'url' => '',
                    'hasdropdwon' => true,
                    'dropdown' => CategoryCourseResource::collection($this['category'])
                ], [
                    'page' => __('tran.freecourse'),
                    'url' => '',
                    'hasdropdwon' => true,
                    'dropdown' => CategoryFreeCourseResource::collection($this['categoryfree'])
                ], [
                    'page' => 'اختبارات تحديد المستوي',
                    'url' => '',
                    'hasdropdwon' => true,
                    'dropdown' => []
                ], [
                    'page' => 'المسابقات',
                    'url' => '/contests',
                    'hasdropdwon' => false,
                    'dropdown' => []

                ], [
                    'page' => 'انضم لفريق المسوقين',
                    'url' => '/affiliate',
                    'hasdropdwon' => false,
                    'dropdown' => []

                ]
            ],
            'section1' => [
                'status'     => $this['section1']['section1_status'] ?? '',
                'title'     => $this['section1']['section1_title'] ?? '',
                'sub_title' => $this['section1']['section1_sub_title'] ?? '',
                'body'      => $this['section1']['section1_body'] ?? '',
                'slider'    =>  SliderResource::collection($this['slider']) ?? '',
            ],
            'section2' => [
                'status'     => $this['section2']['section2_status'] ?? '',
                'title'     => $this['section2']['section2_title'] ?? '',
                'body'      => $this['section2']['section2_body'] ?? '',
                'image'     => path('', 'home') . $this['section2']['section2_image'] ?? '',

            ],
            'section3' => [
                'status'     => $this['section3']['section3_status'] ?? '',
                'title'     => $this['section3']['section3_title'] ?? '',
                'category'  => $this['category'],
            ],
            'section4' => [
                'status'     => $this['section4']['section4_status'] ?? '',
                'title'     => $this['section4']['section4_title'] ?? '',
                'body'     => $this['section4']['section4_body'] ?? '',
                'image'     => path('', 'home') . $this['section4']['section4_image'] ?? '',

            ],
            'section5' => [
                'status'        => $this['section5']['section5_status'] ?? '',
                'title'         => $this['section5']['section5_title'] ?? '',
                'sub_title'     => $this['section5']['section5_sub_title'] ?? '',
                'say_about_us'  => AboutUsResource::collection($this['aboutus'])
            ],
            'section6' => [
                'status'        => $this['section6']['section6_status'] ?? '',
                'title'         => $this['section6']['section6_title'] ?? '',
                'sub_title'     => $this['section6']['section6_sub_title'] ?? '',
                'blog'  => BlogResource::collection($this['blog'])
            ],
            'section7' => [
                'status'        => $this['section7']['section7_status'] ?? '',
                'title'         => $this['section7']['section7_title'] ?? '',
                'sub_title'     => $this['section7']['section7_sub_title'] ?? '',
                'fqa'  => FqaResource::collection($this['fqa'])
            ],
            'section8' => [
                'status'        => $this['section8']['section8_status'] ?? '',
                'title'         => $this['section8']['section8_title'] ?? '',
                'sub_title'     => $this['section8']['section8_sub_title'] ?? '',
                'image'     => path(null, 'home') . '8a64d8f58c69c40d93e2b4665b800795.jpg',
            ],
            'footer' => [
                'phone'      => $this['footer']['phone'] ?? '',
                'address'    => $this['footer']['address'] ?? '',
                'mail'       => $this['footer']['mail'] ?? '',
                'facebook'   => $this['footer']['facebook'] ?? '',
                'instegram'  => $this['footer']['instegram'] ?? '',
                'telegram'   => $this['footer']['telegram'] ?? '',
                'linkedin'   => $this['footer']['linkedin'] ?? '',
                'youtube'    => $this['footer']['youtube'] ?? '',
                'description' => $this['footer']['description'] ?? '',
                'copyright'   => $this['footer']['copyright'] ?? ''
            ]



        ];
    }
}
