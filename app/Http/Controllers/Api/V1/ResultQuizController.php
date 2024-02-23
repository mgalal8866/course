<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositoryinterface\ResultQuizRepositoryinterface;

class ResultQuizController extends Controller
{
    private $resultquiz;
    public function __construct(ResultQuizRepositoryinterface $resultquiz)
    {
        $this->resultquiz = $resultquiz;
    }

    function send_answers(Request $request)
    {
        return  $data = $this->resultquiz->send_answers();

        // return Resp(QuizCollectionResource::collection($data), 'success');
    }
}
