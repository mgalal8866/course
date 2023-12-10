<?php

namespace App\Repository;

use App\Models\Category;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;
use Illuminate\Database\Eloquent\Model;

class DBCategoryCourseRepository implements CategoryCourseRepositoryinterface
{

    protected Model $model;
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
