<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HomePageResource;
use App\Http\Resources\CategoryCourseResource;
use App\Models\Category;

class HomeController extends Controller
{

    public function homepage(){
            $data =[];
            $set = Setting::where('active',1)->get();
            $set = $set->pluck('value', 'key')->toarray();
            $data = array_map(function ($value) {
                if ($value === null) {
                    return '';
                }
                return $value === null ? '' : $value;

            }, $set);
            $data['setting']  =  $set;
            $data['slider']   = Slider::get();
            $data['category'] = CategoryCourseResource::collection(Category::withCount('courses')->get());;
            // $data['slider']= Slider::get();
            // $data['slider']= Slider::get();
            // $data['slider']= Slider::get();
        return new HomePageResource($data);
    }
    public function getsetting()
    {
        // return app('getSetting');

        $set = Setting::where('active',1)->get();
        $set = $set->pluck('value', 'key')->toarray();
        $data = array_map(function ($value) {
            if ($value === null) {
                return '';
            }
            return $value === null ? '' : $value;

        }, $set);
        return Resp($data, 'success');
    }
    public function getslider()
    {
        return Resp(Slider::get(), 'success');
    }
}
