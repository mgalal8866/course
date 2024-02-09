<?php

namespace App\Repository;

use App\Models\CategoryGrades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryGradesRepositoryinterface;

class DBCategoryGradesRepository implements CategoryGradesRepositoryinterface
{

    protected Model $model;
    public function __construct(CategoryGrades $model)
    {
        $this->model = $model;
    }
    public function get_category()
    {
        $data =  $this->model->get();
        return Resp($data, 'Success', 200, true);

    }
}
