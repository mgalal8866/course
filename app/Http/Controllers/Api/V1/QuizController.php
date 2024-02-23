<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Quizes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Http\Resources\QuizCollectionResource;
use App\Repositoryinterface\QuizRepositoryinterface;

class QuizController extends Controller
{
    private $categoryquiz;
    public function __construct(QuizRepositoryinterface $categoryquiz)
    {
        $this->categoryquiz = $categoryquiz;
    }

    function get_quiz_by_category(Request $request)
    {
        if ($request->has('category_id'))
            $data = $this->categoryquiz->get_quiz_by_category($request->category_id);

        return Resp(QuizCollectionResource::collection($data), 'success');
    }
    function get_quiz_by_id(Request $request)
    {

        if ($request->has('quiz_id'))
            $data = $this->categoryquiz->get_quiz_by_id($request->quiz_id);
        
        return Resp(new QuizResource($data), 'success');
    }
}
