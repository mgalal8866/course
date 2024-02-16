<?php

namespace App\Repository;

use App\Models\CourseEnrolleds;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CourseEnrolledRepositoryinterface;

class DBCourseEnrolledRepository implements CourseEnrolledRepositoryinterface
{

    protected Model $model;
    protected $request;

    public function __construct(CourseEnrolleds $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }


    public function get_my_course()
    {
        return $this->model->with(['course'])->get();
    }
    
}
