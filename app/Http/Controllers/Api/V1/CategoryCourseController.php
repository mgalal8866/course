<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCourseResource;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;

class CategoryCourseController extends Controller
{
    private $CategoryCourse;
    public function __construct(CategoryCourseRepositoryinterface $CategoryCourse)
    {
        $this->CategoryCourse = $CategoryCourse;
    }
    function getcategorycourse()
    {
        $data = CategoryCourseResource::collection($this->CategoryCourse->getCategoryCourse());
        return Resp( $data,'success' );
    }
}
