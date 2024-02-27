<?php

namespace App\Repository;

use App\Models\Quiz_question_answers;
use App\Models\Quiz_questions;
use Carbon\Carbon;
use App\Models\Quizes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\ResultQuizRepositoryinterface;

class DBResultQuizRepository implements ResultQuizRepositoryinterface
{


    protected Model $model;
    protected $request;

    public function __construct(Quizes $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function  send_answers()
    {
        if ($this->request->has('data')) {
            $questions = array_map(function($item) {
                return $item['answer'];
            }, $this->request['data']);

            $dd =   Quiz_question_answers::with(['question','question.quize'])->whereIn('id', $questions )->get();
            $r='' ;
            $totalDegree = $dd->sum(function ($item)use($r) {
                if($item->correct != 0){
                    $r = $item->question->degree;
                    return $item->question->degree;
                }
            });
            dd($totalDegree);
           foreach($dd as $data){

               dd($data->question->degree);
           };
        };
    }
}
