<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Setting;
use App\Models\Slider;
use App\Repositoryinterface\CourseRepositoryinterface;
use Illuminate\Database\Eloquent\Model;

class CourseController extends Controller
{
    private $course;
    public function __construct(CourseRepositoryinterface $course)
    {
        $this->course = $course;
    }

    public function getCategoryCourse($category_id)
    {

        return Resp($this->course->getcourse($category_id), 'success');
    }
    public function getcourse($category_id)
    {
        $data = $this->course->getcourse($category_id);

        return Resp(CourseResource::collection($data), 'success');
    }
}
