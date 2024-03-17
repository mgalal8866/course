<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Quizes;
use App\Models\QuizResultHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $question = $this->model->withCount('question')->with(['question', 'question.answer'])->find($quiz_id);

        if (Auth::guard('student')->check()) {
            $user_id = Auth::guard('student')->user()->id;
            $QuizResultHeader = QuizResultHeader::where(['quiz_id' => $quiz_id, 'user_id' => $user_id])->with(['quiz_result_details'])->first();

            $newrow = ["batch" => '1', "start" => Carbon::now(), "finish" => '', 'time' => '', 'total_question' =>  '', 'answered' => '0', 'not_answered' => '0'];
            if ($QuizResultHeader == null) {
                $QuizResultHeader =   QuizResultHeader::Create(['quiz_id' => $quiz_id, 'user_id' => $user_id, 'history' => [$newrow]]);
            }

            $qq = $QuizResultHeader->quiz_result_details->pluck('question_id');
            $question = $this->model->withCount('question')->with([
                'question' => function ($query) use ($qq) {
                    $query->whereNotIn('id', $qq);
                }, 'question.answer'
            ])->find($quiz_id);
            if ($QuizResultHeader) {
                if (!empty($QuizResultHeader->history)) {
                    // dd(array_column($QuizResultHeader->history, 'batch'));
                    $max = max(array_column($QuizResultHeader->history, 'batch'));

                    if ($QuizResultHeader->history[$max - 1]['answered'] == 0 && $QuizResultHeader->history[$max - 1]['not_answered'] == 0) {

                        $history  = $QuizResultHeader->history;
                        $history[$max - 1]['start']    = Carbon::now();
                        $QuizResultHeader->history = $history;
                        $QuizResultHeader->save();
                    } else {
                        $newEntry = [
                            "batch"         => $max + 1,
                            "start"         => Carbon::now(),
                            "finish"        => '',
                            'time'          => '',
                            'total_question' => number_format($question->questions_count),
                            'answered'      => '0',
                            'not_answered'  => '0',
                        ];
                        $history = $QuizResultHeader->history;
                        $history[] = $newEntry;
                        $QuizResultHeader->history = $history;
                        $QuizResultHeader->save();
                    }
                } else {
                    $history[] = $newrow;
                    $QuizResultHeader->history = $newrow;
                    $QuizResultHeader->save();
                }
            } else {

                $QuizResultHeader =   QuizResultHeader::Create(['quiz_id' => $quiz_id, 'user_id' => $user_id, 'history' => [$newrow]]);
            }
        } else {
            $question = $this->model->withCount('question')->with(['question', 'question.answer'])->find($quiz_id);
        }
        return $question;
    }
}
