<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseByIdResource;
use App\Models\CourseEnrolleds;
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
        return Resp($data, 'success');

    }
    
}
