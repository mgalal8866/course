<?php

namespace App\Repository;

use App\Models\CategoryQuiz;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryQuizRepositoryinterface;

class DBCategoryQuizRepository  implements CategoryQuizRepositoryinterface
{

    protected Model $model;
    public function __construct(CategoryQuiz $model)
    {
        $this->model = $model;
    }

    public function get_category_quiz(){
        return $this->model->get();
    }
}
