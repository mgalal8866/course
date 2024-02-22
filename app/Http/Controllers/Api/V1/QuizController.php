<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\CategoryBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryBookResource;
use App\Http\Resources\CategoryQuizResource;
use App\Repositoryinterface\QuizRepositoryinterface;
use App\Repositoryinterface\CategoryQuiz;

class QuizController extends Controller
{
    private $categoryquiz;
    public function __construct(QuizRepositoryinterface $categoryquiz)
    {
        $this->categoryquiz = $categoryquiz;
    }

    function get_category_quiz()
    {
        $data= $this->categoryquiz->get_quiz();
          return Resp(CategoryQuizResource::collection($data),'success');
    }
}
