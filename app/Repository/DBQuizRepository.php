<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Quizes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\QuizRepositoryinterface;

class DBQuizRepository implements QuizRepositoryinterface
{


    protected Model $model;
    protected $request;

    public function __construct(Quizes $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function  get_quiz_by_category($category_id)
    {
        return $this->model->whereCategoryId($category_id)->withCount('question')->get();
    }
    public function  get_quiz_by_id($quiz_id)
    {
        return $this->model->find($quiz_id)->withCount('question')->with(['question','question.answer'])->first();
    }
}
