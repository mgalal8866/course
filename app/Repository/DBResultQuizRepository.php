<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Quizes;
use Illuminate\Http\Request;
use App\Models\Quiz_questions;
use App\Models\QuizResultHeader;
use App\Models\QuizResultDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz_question_answers;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ResultQuizResource;
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
            $questions = array_map(function ($item) {
                return $item['answer'];
            }, $this->request['data']);

            $Quiz_question_answers = Quiz_question_answers::with(['question', 'question.quize'])->whereIn('id', $questions)->get();
            // dd($Quiz_question_answers);
            $r  = '';
            $totalDegree = $Quiz_question_answers->sum(function ($item) use ($r) {
                if ($item->correct != 0) {
                    $r = $item->question->mark;
                    return $item->question->mark;
                }
            });
            // ,{
            //     "answer":"881ea425-938d-4a4f-b80d-4844d55a5e5f"
            // }
            if (Auth::guard('student')->check()) {
                $user_id = Auth::guard('student')->user()->id;
                $QuizResultHeader = QuizResultHeader::with(['quiz'])->where(['quiz_id' => $Quiz_question_answers[0]->question->quiz_id, 'user_id' => $user_id])->first();

                $max = max(array_column($QuizResultHeader->history, 'batch')) - 1;

                if ($QuizResultHeader->history[$max]['answered'] == 0 && $QuizResultHeader->history[$max]['not_answered'] == 0) {
                    $history                    = $QuizResultHeader->history[$max];
                    $start                      = new Carbon($QuizResultHeader->history[$max]['start']);
                    $totalDuration              = Carbon::now()->diff($start)->format('%H:%I:%S');
                    $history['finish']          = Carbon::now();
                    $history['answered']        = number_format(count($Quiz_question_answers));
                    $history['not_answered']    = number_format(count($Quiz_question_answers[0]->question->quize->question) - count($Quiz_question_answers));
                    $history['time']            = $totalDuration;
                    $updatedHistory = $QuizResultHeader->history;
                    $updatedHistory[$max] = $history;
                    $QuizResultHeader->history = $updatedHistory;

                    $QuizResultHeader->save();
                }
            }
            foreach ($Quiz_question_answers as $data) {
                QuizResultDetails::updateOrCreate(['result_header_id' => $QuizResultHeader->id, 'answer_id' => $data->id], [
                    'result_header_id' => $QuizResultHeader->id,
                    'question_id'      => $data->question_id,
                    'answer_id'        => $data->id,
                    'marks'            => ($data->correct == 1 ? $data->question->mark : 0),
                    'is_correct'       => $data->correct
                ]);
            };
            return new ResultQuizResource($QuizResultHeader);
            // $max = max(array_column($QuizResultHeader->history, 'batch')) - 1;
            // dd($QuizResultHeader->history[ $max]);
        };
    }
}
