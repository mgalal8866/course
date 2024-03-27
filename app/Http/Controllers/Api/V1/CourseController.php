<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Slider;
use App\Models\Stages;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CourseByIdResource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\CourseByIdResourcenotsupscrip;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Http\Resources\Course\CollectionCourseResource;
use App\Http\Resources\Course\CalculatingProgresRateResource;
use App\Models\Courses;
use App\Models\QuizResultHeader;

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
            'childrens' => function ($q) use ($id) {
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

        $data = ['data' => $data];
        // dd($data['data']);
        if (Count($data['data']) != 0) {

            return Resp(new CollectionCourseResource($data), 'success', 200, true);
        } else {
            return Resp(null, 'Not Found Course', 404, false);
        };
    }
    public function get_calc_prog(Request $request)
    {

        $dd = Courses::with(['lessons.quiz', 'lessons' => function ($q) {
            $q->with(['quiz' => function ($qq) {
                $qq->withCount('question');
            }, 'quiz.question'])->where('is_lesson', 0);
        }])->find($request->id);

        $questions = [];
        $user_id = Auth::guard('student')->user()->id;
        foreach ($dd->lessons as $e) {

            $q =   QuizResultHeader::where(['quiz_id' => $e->link_video, 'user_id' => $user_id])->with(['quiz' => function ($q) {
                $q->withCount('question');
            }, 'quiz_result_details'])->first();

            $allqutioncount = $e->quiz->question_count;

            $allquiz_result_detailscount =   $q != null ? $q->quiz_result_details->count() : '0';
            $questions[] = ['name' => $e->name,
            'total_question' =>  number_format($e->quiz->question_count),
            'answer' =>  $q != null ?  number_format($q->quiz_result_details->count()) : '0',
            'not_answer' =>   $q != null ?  number_format($e->quiz->question_count - $q->quiz_result_details->count()) : '0',
            'degree' =>  $q != null ? number_format(($allquiz_result_detailscount / $allqutioncount) * 100 ,1) : '0.0'];
        }

        // $e = '9679fefa-0fdb-4545-862e-6d9a31f258b1';

        // $q =   QuizResultHeader::where('quiz_id',  $request->id)->with(['quiz' => function ($q) {
        //     $q->withCount('question');
        // }, 'quiz_result_details'])->first();
        // $allqutioncount = $q->quiz->question_count;
        // $allquiz_result_detailscount = $q->quiz_result_details->count();
        // dd(($allquiz_result_detailscount / $allqutioncount) * 100);


        // $data =  Stages::with([
        //     'childrens.lessons.quiz.quizresult' => function ($q) use ($request) {
        //         $user_id = Auth::guard('student')->user()->id;
        //         $q->where('user_id', $user_id);
        //     },
        //     'childrens' => function ($q) use ($request) {
        //         $q->whereHas('courses', function ($qq) use ($request) {
        //             $qq->where('course_id', $request->id);
        //         });
        //     }, 'childrens.lessons' => function ($query) use ($request) {
        //         $query->where('is_lesson', '0');
        //     },
        //     // 'childrens.courses'  => function ($query) use ($request) {
        //     //     $query->where('course_id', $request->id);
        //     // }
        // ])->whereHas('childrens', function ($q) use ($request) {
        //     $q->whereHas('courses', function ($qq) use ($request) {
        //         $qq->where('course_id', $request->id);
        //     });
        // })->get();

        // $data = ['data' => $data];
        // dd($data['data']);
        if (Count($questions) != 0) {

            return Resp( $questions, 'success', 200, true);
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
