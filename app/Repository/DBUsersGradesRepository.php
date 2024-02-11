<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use App\Models\UsersGrades;
use App\Repositoryinterface\UsersGradesRepositoryinterface;
use Illuminate\Support\Facades\Hash;

class DBUsersGradesRepository  implements UsersGradesRepositoryinterface
{

    protected Model $model;
    public function __construct(UsersGrades $model)
    {
        $this->model = $model;
    }
    public function get_grades_by_category($id){
        return $this->model->whereCategoryId($id)->whereActive(1)->get();
    }
 }
