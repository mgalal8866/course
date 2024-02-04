<?php

namespace App\Repository;

use App\Models\FreeCourse;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\FreeCourseRepositoryinterface;

class DBFreeCourseRepository implements FreeCourseRepositoryinterface
{

    protected Model $model;
    public function __construct(FreeCourse $model)
    {
        $this->model = $model;
    }

    public function get_free_course_by_category($id){

        return $this->model->whereCategoryId($id)->paginate(1);
    }
    public function get_free_course_by_id($id){

        return $this->model->find($id);
    }
}
