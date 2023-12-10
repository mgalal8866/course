<?php

namespace App\Repository;

use App\Models\CategoryFCourse;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;

class DBCategoryFreeCourseRepository implements CategoryFreeCourseRepositoryinterface
{

    protected Model $model;
    public function __construct(CategoryFCourse $model)
    {
        $this->model = $model;
    }

    public function get_category_free_course(){
        return $this->model->active(1)->get();
    }
}
