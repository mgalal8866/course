<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Slider;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HomePageResource;
use App\Http\Resources\HomeSection1Resource;
use App\Http\Resources\HomeSection2Resource;
use App\Http\Resources\HomeSection3Resource;
use App\Http\Resources\HomeSection4Resource;
use App\Http\Resources\CategoryCourseResource;

class HomeController extends Controller
{

    public function section1()
    {
        $data=[];
        $data['setting']  =$this->getsetting('section1_setting', ['section1_statu','section1_title', 'section1_sub_title', 'section1_body' ]);
        $data['slider']   = Slider::get();
        return Resp( new HomeSection1Resource($data), 'success');
    }
    public function section2()
    {
        $data = $this->getsetting('section2_setting', ['section2_statu','section2_title', 'section2_image', 'section2_body']);
        return Resp( new HomeSection2Resource($data), 'success');
    }
    public function section3()
    {
        $data['setting']  = $this->getsetting('section3_setting', ['section3_statu', 'section3_title','section3_body', 'section4_image']);
        $data['category'] = CategoryCourseResource::collection(Category::withCount('courses')->get());;
        return Resp( new HomeSection3Resource($data), 'success');
    }
    public function section4()
    {
        $data  = $this->getsetting('section4_setting', ['section4_statu', 'section4_title','section4_body']);
        return Resp( new HomeSection4Resource($data), 'success');
    }



    public function getsetting($cache, array $value)
    {
        $settings = Cache::rememberForever($cache, function () use ($value) {

            return Setting::whereIn('key', $value)->get();
        });

        $set =  $settings->pluck('value', 'key')->toarray();
        $data = array_map(function ($value) {
            if ($value === null) {
                return '';
            }
            return $value === null ? '' : $value;
        }, $set);
        return $data;
    }
    public function getslider()
    {
        return Resp(Slider::get(), 'success');
    }
}
