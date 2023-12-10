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
}
