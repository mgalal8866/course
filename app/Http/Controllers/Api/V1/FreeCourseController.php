<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\FreeCourseByIdResource;
use App\Http\Resources\FreeCoursesByCategoryResource;
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
        $data = FreeCoursesByCategoryResource::collection($this->FreeCourse->get_free_course_by_category($id));
        return Resp( $data );
    }
    function get_free_course_by_id($id)
    {
        $data = new FreeCourseByIdResource($this->FreeCourse->get_free_course_by_id($id));
        return Resp( $data );
    }
}
