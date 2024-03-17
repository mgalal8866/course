<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\CourseEnrolleds;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseByIdResource;
use App\Http\Resources\CoursesEnrolledResource;
use App\Http\Resources\CoursesCategoryEnrolledResource;
use App\Repositoryinterface\CourseEnrolledRepositoryinterface;


class CourseEnrolledController extends Controller
{
    private $courseenrolled;
    public function __construct(CourseEnrolledRepositoryinterface $courseenrolled)
    {
        $this->courseenrolled = $courseenrolled;
    }

    public function get_my_course()
    {

        $data = $this->courseenrolled->get_my_course();
        return Resp(CoursesEnrolledResource::collection($data), 'success');

    }
    public function get_category_my_course()
    {
        $data = $this->courseenrolled->get_category_my_course();
        return Resp(CoursesCategoryEnrolledResource::collection($data), 'success');

    }

}
