<?php

namespace App\Repository;

use App\Models\CategoryExams;
use App\Models\CategoryQuiz;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryQuizRepositoryinterface;
use Illuminate\Http\Request;

class DBCategoryQuizRepository  implements CategoryQuizRepositoryinterface
{

    protected Model $model;
    protected  $request;
    public function __construct(CategoryExams $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;

    }

    public function get_category_quiz(){
        $type = $this->request->input('type', 1);
        return $this->model->where('typecategory',$type)->get();
    }
}
