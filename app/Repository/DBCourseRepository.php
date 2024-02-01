<?php

namespace App\Repository;

use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CourseRepositoryinterface;


class DBCourseRepository implements CourseRepositoryinterface
{

    protected Model $model;
    public function __construct(Courses $model)
    {
        $this->model = $model;
    }

    public function getcoursesbycategroy($category_id)
    {
       return $this->model->where('category_id',$category_id)->get();
    }
    public function getcoursebyid($id)
    {
    //    return $this->model->with('stages.lessons')->find($id);
       $course = $this->model->with(['stages' => function ($query) {
        $query->distinct();
    }, 'stages.lessons'])->find($id);
    return  $course ;
    }




}
