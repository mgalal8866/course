<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'header'    => [
                'home' => '',
                'logo' => ''
            ],
            'section_1' => [
                'statu'     => $this['setting']['section1_statu']??'',
                'title'     => $this['setting']['section1_title']??'',
                'sub_title' => $this['setting']['section1_sub_title']??'',
                'body'      => $this['setting']['section1_body']??'',
                'slider'    => $this['slider'],
            ],
            'section_2' =>[
                'statu'     => $this['setting']['section2_statu']??'',
                'title'     => $this['setting']['section2_title']??'',
                'body'      => $this['setting']['section2_body']??'',
                'image'     => $this['setting']['section2_image']??'',
            ],
            'section_3'  =>[
                'statu'     => $this['setting']['section3_statu']??'',
                'title'     => $this['setting']['section3_title']??'',
                'category'  => $this['category'],
            ],
            'section_4' =>[
                'statu'     =>  $this['setting']['section4_statu']??'',
                'title'     =>  $this['setting']['section4_title']??'',
                'body'      => $this['setting']['section4_body']??'',
            ],
            'footer'    => [
                'logo'      =>'',
                'instagram' =>$this['setting']['instegram'],
                'linkedin'  =>$this['setting']['linkedin']??'',
                'youtube'   =>$this['setting']['youtube']??'',
                'facebook'  =>$this['setting']['facebook']??'',
                'phone'     =>$this['setting']['phone']??'',
                'address'   =>$this['setting']['address']??'',
                'mail'      =>$this['setting']['mail']??''
            ],

        ];
    }
}
