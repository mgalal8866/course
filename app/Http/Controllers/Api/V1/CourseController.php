<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Slider;
use App\Models\Stages;
use App\Models\Courses;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\QuizResultHeader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CourseByIdResource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\Caluc\ParentStagesResource;
use App\Http\Resources\CourseByIdResourcenotsupscrip;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Http\Resources\Course\CollectionCourseResource;
use App\Http\Resources\Course\CalculatingProgresRateResource;

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
                })->with(['lessons' => function ($qe) use ($id) {
                    $qe->wherePivot('course_id',$id);
                }]);
            }, 'childrens.lessons',
            'childrens.courses.comments',
            'childrens.courses.coursetrainers',
            'childrens.courses'  => function ($query) use ($id) {
                $query->where('course_id', $id);
            }
        ])->whereHas('childrens', function ($q) use ($id) {
            $q->whereHas('courses', function ($qq) use ($id) {
                $qq->where('course_id', $id);
            });
        })->get();

        $data = ['data' => $data];
        if (Count($data['data']) != 0) {

            return Resp(new CollectionCourseResource($data), 'success', 200, true);
        } else {
            return Resp(null, 'Not Found Course', 404, false);
        };
    }
    public function get_calc_prog(Request $request)
    {

        $dd = Courses::with(['lessons.quiz', 'lessons' => function ($q) {
            $q->with(['stages._parent', 'quiz' => function ($qq) {
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
            $questions[] = [
                'name' => $e->name,
                'total_question' =>  number_format($e->quiz->question_count),
                'answer' =>  $q != null ?  number_format($q->quiz_result_details->count()) : '0',
                'not_answer' =>   $q != null ?  number_format($e->quiz->question_count - $q->quiz_result_details->count()) : '0',
                'degree' =>  $q != null ? number_format(($allquiz_result_detailscount / $allqutioncount) * 100, 1) : '0.0'
            ];
        }
        if (Count($questions) != 0) {
            return Resp($questions, 'Not Found Course', 200);
        } else {
            return Resp(null, 'Not Found Course', 404, false);
        };
    }
    public function get_calc_prog2(Request $request)
    {
        $user_id = Auth::guard('student')->user()->id;
        $user_id = '53cd3b3e-2ad8-4036-8798-e0a0a2847c03';
        $data =  Stages::with([
            'childrens' => function ($q) use ($request) {
                $q->whereHas('courses', function ($qq) use ($request) {
                    $qq->where('course_id',  $request->id)->select(['courses.id', 'courses.name']);
                })->whereHas('lessons', function ($q) use ($request) {
                    $q->where('is_lesson', 0)
                    ->select(['lessons.id', 'lessons.name']);
                })
                ->with(['lessons' => function ($qe) use ($request) {
                    $qe->with(['quiz' => function ($qq) {
                            $qq->select('id', 'name')->withCount('question');
                        }])
                        ->where('is_lesson', 0)->wherePivot('course_id',$request->id);
                }])
                ;
            },
        ])->whereHas('childrens', function ($q) use ($request) {
            $q->whereHas('courses', function ($qq) use ($request) {
                $qq->where('course_id',  $request->id);
            });
        })->get();
        $questions = [];

        foreach ($data as $instages => $Stages) {
            foreach ($Stages->childrens as $child) {
                if ($child->lessons->count() > 0) {

                    $questions[] = [
                        'stage' =>  $Stages->name,
                        'quiz' => []
                    ];
                    foreach ($child->lessons as $les) {
                        $q =   QuizResultHeader::where(['quiz_id' => $les->link_video, 'user_id' => $user_id])->with(['quiz' => function ($q) {
                            $q->withCount('question');
                        }, 'quiz_result_details'])->first();

                        $allqutioncount = $les->quiz->question_count;
                        $allquiz_result_detailscount =   $q != null ? $q->quiz_result_details->count() : '0';

                        $questions[count($questions) - 1]['quiz'][count($questions[count($questions) - 1]['quiz'])]  =   [

                            'quiz_name' => $les->quiz->name,
                            // 'quiz_id' => $les->quiz->id,
                            // 'quiz_result_details' =>   $q,
                            // 'total_question' =>  number_format($les->quiz->question_count),
                            // 'answer' =>  $q != null ?  number_format($q->quiz_result_details->count()) : '0',
                            // 'not_answer' =>   $q != null ?  number_format($les->quiz->question_count - $q->quiz_result_details->count()) : '0',
                            'degree' =>  $q != null ? number_format(($allquiz_result_detailscount / $allqutioncount) * 100, 1) : '0.0'
                        ];
                        //  array_push($dataa, $data);
                    }

                    $total_degree= collect($questions[count($questions) - 1]['quiz'])->sum('degree');
                    $count_quiz= (count( $questions[count($questions) - 1]['quiz'])*100);
                    $final_total_degree =+ collect($questions[count($questions) - 1]['quiz'])->sum('degree');
                    $final_count_quiz =+  (count( $questions[count($questions) - 1]['quiz'])*100);
                    $questions[count($questions) - 1]['result']=[
                        'rate' =>($total_degree != 0)? (($total_degree/$count_quiz) * 100) :0
                    ] ;
                }
            }
        }
     $questions['final']= ($final_total_degree != 0)? (($final_total_degree/ $final_count_quiz)*100): 0;


        return Resp($questions, 'success', 200, true);
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
