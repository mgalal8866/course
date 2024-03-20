<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CollectionCourseResource;
use App\Http\Resources\CourseResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CourseByIdResource;
use App\Http\Resources\CourseByIdResourcenotsupscrip;
use App\Http\Resources\PaginationResource;
use App\Models\Stages;
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
        // $data = $this->course->getcoursesbycategroy($category_id);
        $data = new PaginationResource($this->course->getcoursesbycategroy($category_id), CourseResource::class, 'categories');

        return Resp($data, 'success');
    }
    public function getcoursebyidsubscripe($id)
    {
        $data = $this->course->getcoursebyid($id);
        if ($data != null) {

            return Resp(new CourseByIdResource($data), 'success');
        } else {
            return Resp(null, 'Not Found Course', 404, false);
        };
    }
    public function getcoursebyidsubscripe2($id)
    {
        $data =  Stages::with([
            'childrens'=> function ($q) use ($id) {
                $q->whereHas('courses', function ($qq) use ($id) {
                    $qq->where('course_id', $id);
                });
            }, 'childrens.lessons',
            'childrens.courses.comments',
            'childrens.courses.coursetrainers',
            'childrens.courses'  => function ($query) use ($id) {
                // $query->where('course_id', $id)->first();
                $query->where('course_id', $id);
            }
        ])->whereHas('childrens', function ($q) use ($id) {
            $q->whereHas('courses', function ($qq) use ($id) {
                $qq->where('course_id', $id);
            });
        })->get();

        $data=['data'=>$data];
// dd($data['data']);
        if (Count($data['data']) != 0) {

            return Resp(new CollectionCourseResource($data), 'success', 200, true);
        } else {
            return Resp(null, 'Not Found Course', 404, false);
        };
    }
    public function getcoursebyidnot_subscribed($id)
    {
        $data = $this->course->getcoursebyid($id);
        if ($data != null) {

            return Resp(new CourseByIdResourcenotsupscrip($data), 'success');
        } else {
            return Resp(null, 'Not Found Course', 404, false);
        };
    }
    // public function get_my_course()
    // {
    //     $data = $this->course->get_my_course();
    //     if( $data !=null){

    //         return Resp(new CourseByIdResource($data), 'success');
    //      }else{
    //          return Resp(null,'Not Found Course',404,false);

    //      };
    // }
}
