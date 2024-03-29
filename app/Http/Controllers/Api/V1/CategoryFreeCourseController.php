<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryFreeCourseResource;
use App\Http\Resources\PaginationResource;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;

class CategoryFreeCourseController extends Controller
{
    private $CategoryFreeCourse;
    public function __construct(CategoryFreeCourseRepositoryinterface $CategoryFreeCourse)
    {
        $this->CategoryFreeCourse = $CategoryFreeCourse;
    }
    function getcategoryfreecourse()
    {
        // $data = new PaginationResource($this->CategoryFreeCourse->get_category_free_course(),CategoryFreeCourseResource::class);
        $data = CategoryFreeCourseResource::collection($this->CategoryFreeCourse->get_category_free_course());
        return Resp( $data );
    }

}
