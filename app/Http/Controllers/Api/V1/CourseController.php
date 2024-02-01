<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CourseByIdResource;
use App\Repositoryinterface\CourseRepositoryinterface;

class CourseController extends Controller
{
    private $course;
    public function __construct(CourseRepositoryinterface $course)
    {
        $this->course = $course;
    }


    public function getcoursesbycategroy($category_id)
    {
        $data = $this->course->getcoursesbycategroy($category_id);

        return Resp(CourseResource::collection($data), 'success');
    }
    public function getcoursebyid($id)
    {
        $data = $this->course->getcoursebyid($id);
           if( $data !=null){

               return Resp(new CourseByIdResource($data), 'success');
            }else{
                return Resp(null,'Not Found Course',404,false);

            };
    }
}
