<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Fqa;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryFCourse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SliderResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HomePageResource;
use App\Http\Resources\HomeFooterResource;
use App\Http\Resources\HomeHeaderResource;
use App\Http\Resources\HomeSection1Resource;
use App\Http\Resources\HomeSection2Resource;
use App\Http\Resources\HomeSection3Resource;
use App\Http\Resources\HomeSection4Resource;
use App\Http\Resources\HomeSection5Resource;
use App\Http\Resources\HomeSection6Resource;
use App\Http\Resources\HomeSection7Resource;
use App\Http\Resources\HomeSection8Resource;
use App\Http\Resources\CategoryCourseResource;
use App\Models\Comments;

class HomeController extends Controller
{

    public function homep()
    {

        Cache::forget('categoryfree');
        Cache::forget('fqa');
        Cache::forget('aboutus');
        Cache::forget('blog');

        $data['footer'] = getsetting('footer_setting', [
            'phone', 'address', 'mail',
            'facebook', 'instegram', 'telegram', 'linkedin', 'youtube', 'description', 'copyright'
        ]);

        $categoryfree = Cache::rememberForever('categoryfree', function () {
            return        CategoryFCourse::get();
        });
        $data['categoryfree']   = $categoryfree;
        $data['section1']  = getsetting('section1_setting', [ 'section1_title', 'section1_sub_title', 'section1_body']);

        $data['section2']  = getsetting('section2_setting', ['section2_status', 'section2_title', 'section2_image', 'section2_body']);
        $data['section3']  = getsetting('section3_setting', ['section3_status', 'section3_title', 'section3_body', 'section4_image']);
        $data['section4']  = getsetting('section4_setting', ['section4_status', 'section4_title', 'section4_body', 'section4_image']);
        $data['section5']  = getsetting('section5_setting', ['section5_status', 'section5_title', 'section5_sub_title']);
        $data['section6']  = getsetting('section6_setting', ['section6_status', 'section6_title', 'section6_sub_title']);
        $data['section7']  = getsetting('section7_setting', ['section7_status', 'section7_title', 'section7_sub_title']);
        $data['section8']  = getsetting('section8_setting', ['section8_status', 'section8_title', 'section8_sub_title']);

        $fqa = Cache::rememberForever('fqa', function () {
            return         $data['fqa'] = Fqa::where('pin', 1)->get();
        });
        $aboutus = Cache::rememberForever('aboutus', function () {
            return         Comments::whereAboutUs('1')->with('user')->orderBy(DB::raw('RAND()'))->take(3)->get();
        });
        $blog = Cache::rememberForever('blog', function () {
            return         $data['blog'] = Blog::orderBy(DB::raw('RAND()'))->take(3)->get();
        });
        // $slider = Cache::rememberForever('slider', function () {
        //     return    Slider::where('active',1)->get();
        // });
        $data['fqa'] = $fqa;
        $data['blog'] = $blog;
        $data['aboutus'] = $aboutus;
        $data['category'] = CategoryCourseResource::collection(Category::whereHas('courses')->withCount('courses')->get());;
        // $data['slider']   = $slider;

        return Resp(new HomeResource($data), 'success');
    }


    public function get_say_about_us()
    {
        $aboutus = Cache::rememberForever('say_about_u', function () {
            return         Comments::whereAboutUs('1')->with('user')->get();
        });
    }

    public function homefooter()
    {
        $data = getsetting('footer_setting', [
            'phone', 'address', 'mail',
            'facebook', 'instegram', 'telegram', 'linkedin', 'youtube', 'description', 'copyright'
        ]);

        return Resp(new HomeFooterResource($data), 'success');
    }
    public function get_privacy()
    {
        $data = getsetting('privacy', ['privacy']);

        return Resp( $data, 'success');
    }
    public function get_terms_and_conditions()
    {
        $data = getsetting('terms_and_conditions', ['terms_and_conditions']);

        return Resp( $data, 'success');
    }
    public function get_about_us()
    {
        $data = getsetting('about_us', ['about_us']);

        return Resp( $data, 'success');
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
        // $data = [];
        // $data['setting']  = getsetting('section1_setting', ['section1_status', 'section1_title', 'section1_sub_title', 'section1_body']);
        $data   = Slider::where('active',1)->get();
        return Resp( SliderResource::collection($data), 'success');
    }
    // public function section2()
    // {
    //     $data = [];
    //     $data = getsetting('section2_setting', ['section2_status', 'section2_title', 'section2_image', 'section2_body']);
    //     return Resp(new HomeSection2Resource($data), 'success');
    // }
    // public function section3()
    // {
    //     $data['setting']  = getsetting('section3_setting', ['section3_status', 'section3_title', 'section3_body', 'section4_image']);
    //     $data['category'] = CategoryCourseResource::collection(Category::withCount('courses')->get());;
    //     return Resp(new HomeSection3Resource($data), 'success');
    // }
    // public function section4()
    // {
    //     $data['setting']    = getsetting('section4_setting', ['section4_status', 'section4_title', 'section4_body', 'section4_image']);
    //     return Resp(new HomeSection4Resource($data), 'success');
    // }
    // public function section5()
    // {

    //     $data = [];
    //     $data['setting']  = getsetting('section5_setting', ['section5_status', 'section5_title', 'section5_sub_title']);
    //     $data['aboutus'] = AboutUs::with('user')->orderBy(DB::raw('RAND()'))->take(3)->get();

    //     return Resp(new HomeSection5Resource($data), 'success');
    // }
    // public function section6()
    // {

    //     $data = [];
    //     $data['setting']  = getsetting('section6_setting', ['section6_status', 'section6_title', 'section6_sub_title']);
    //     $data['blog'] = Blog::orderBy(DB::raw('RAND()'))->take(3)->get();

    //     return Resp(new HomeSection6Resource($data), 'success');
    // // }
    // public function section7()
    // {

    //     $data = [];
    //     $data['setting']  = getsetting('section7_setting', ['section7_status', 'section7_title', 'section7_sub_title']);
    //     $data['fqa'] = Fqa::where('pin', 1)->get();

    //     return Resp(new HomeSection7Resource($data), 'success');
    // }
    // public function section8()
    // {

    //     $data = [];
    //     $data['setting']  = getsetting('section8_setting', ['section8_status', 'section8_title', 'section8_sub_title']);

    //     return Resp(new HomeSection8Resource($data), 'success');
    // }




    public function getslider()
    {
        return Resp(Slider::where('active',1)->get(), 'success');
    }
}
