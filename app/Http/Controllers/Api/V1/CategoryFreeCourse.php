<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryFreeCourseResource;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;

class CategoryFreeCourse extends Controller
{
    private $CategoryFreeCourse;
    public function __construct(CategoryFreeCourseRepositoryinterface $CategoryFreeCourse)
    {
        $this->CategoryFreeCourse = $CategoryFreeCourse;
    }
    function getcategoryfreecourse()
    {
        $data = CategoryFreeCourseResource::collection($this->CategoryFreeCourse->get_category_free_course());
        return Resp( $data );
    }
}
