<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\FreeCourseResource;
use App\Repositoryinterface\FreeCourseRepositoryinterface;

class FreeCourseController extends Controller
{
    private $FreeCourse;
    public function __construct(FreeCourseRepositoryinterface $FreeCourse)
    {
        $this->FreeCourse = $FreeCourse;
    }

    function get_free_course_by_category($id)
    {
        $data = FreeCourseResource::collection($this->FreeCourse->get_free_course_by_category($id));
        return Resp( $data );
    }
}
