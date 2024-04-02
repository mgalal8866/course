<?php

namespace App\Repository;

use App\Models\Blog;
use App\Models\CourseRating;
use App\Models\CourseRatingDetailsResult;
use Illuminate\Http\Request;
use App\Models\CourseRatingResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\RatingRepositoryinterface;

class DBRatingRepository implements RatingRepositoryinterface
{
    protected Model $model,$CourseRatingResult;
    protected  $request;
    public function __construct(CourseRating $model,CourseRatingResult $CourseRatingResult,Request $request)
    {
        $this->model = $model;
        $this->CourseRatingResult = $CourseRatingResult;
        $this->request = $request;
    }

    public function get_rating_course()
    {
        $rating =$this->model->get();
        return  $rating ;
    }
    public function get_rating_result()
    {
        $course_id=$this->request->input('course_id');
        $rating =$this->CourseRatingResult->with(['course_rating_details','course_rating_details.courserating'])->whereCourseId($course_id)->whereUserId(Auth::guard('student')->user()->id)->first();
        return  $rating ;
    }
    public function send_rating_result()
    {
        $course_id=$this->request->input('course_id');
        $data=$this->request;

        $rating =$this->CourseRatingResult->create(['course_id'=>$course_id,'user_id'=>Auth::guard('student')->user()->id,'comment'=>$data['comment']]);
     foreach($data['rating'] as $item){
        CourseRatingDetailsResult::create(['course_rating_results_id'=>$rating->id,'rating_id'=>$item['question_id'],'rating'=>$item['rating']]);
    }
    return  $rating ;

    }
}
