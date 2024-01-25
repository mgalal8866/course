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
use App\Http\Resources\HomeFooterResource;
use App\Http\Resources\HomeHeaderResource;
use App\Models\CategoryFCourse;

class HomeController extends Controller
{

    public function homefooter()
    {
        $data = getsetting('footer_setting', ['phone', 'address', 'mail',
         'facebook','instegram','telegram','linkedin','youtube','description','copyright']);

        return Resp(new HomeFooterResource($data), 'success');
    }
    public function homeheader()
    {
        $data = [];
        $data['category']  = Category::withCount('courses')->get();
        $data['categoryfree']   = CategoryFCourse::get();

        return Resp(new HomeHeaderResource($data), 'success');
    }
    public function section1()
    {
        $data = [];
        $data['setting']  = getsetting('section1_setting', ['section1_status', 'section1_title', 'section1_sub_title', 'section1_body']);
        $data['slider']   = Slider::get();
        return Resp(new HomeSection1Resource($data), 'success');
    }
    public function section2()
    {
        $data = [];
        $data = getsetting('section2_setting', ['section2_status', 'section2_title', 'section2_image', 'section2_body']);
        return Resp(new HomeSection2Resource($data), 'success');
    }
    public function section3()
    {
        $data['setting']  = getsetting('section3_setting', ['section3_status', 'section3_title', 'section3_body', 'section4_image']);
        $data['category'] = CategoryCourseResource::collection(Category::withCount('courses')->get());;
        return Resp(new HomeSection3Resource($data), 'success');
    }
    public function section4()
    {
        $data  = getsetting('section4_setting', ['section4_status', 'section4_title', 'section4_body', 'section4_image']);
        return Resp(new HomeSection4Resource($data), 'success');
    }




    public function getslider()
    {
        return Resp(Slider::get(), 'success');
    }
}
