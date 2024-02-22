<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\CategoryBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryBookResource;
use App\Http\Resources\CategoryQuizResource;
use App\Repositoryinterface\CategoryQuizRepositoryinterface;

class CategoryQuizController extends Controller
{
    private $categoryquiz;
    public function __construct(CategoryQuizRepositoryinterface $categoryquiz)
    {
        $this->categoryquiz = $categoryquiz;
    }

    function get_category_quiz()
    {
        $data= $this->categoryquiz->get_category_quiz();
          return Resp(CategoryQuizResource::collection($data),'success');
    }
}
