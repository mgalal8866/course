<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quizes;
use App\Models\Stages;
use App\Models\Lessons;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryFCourse;
use App\Http\Controllers\Controller;
use App\Models\CourseStages;
use App\Models\Quiz_question_answers;
use App\Models\Quiz_questions;
use Illuminate\Support\Facades\Validator;

class QizeController extends Controller
{


    public function getquestion(Request $request)
    {
        $quiz = Quizes::where('id', $request->id)->with(['question', 'question.answer'])->first();
        return view('dashboard.quizzes.view-questions', compact(['quiz']));
    }
    public function getModal($id,$quiz)
    {

        $question =  Quiz_questions::with('answer')->find($id);
        $question = $question == null ? [] : $question;

        return view('dashboard.quizzes.edit-header-ajax', compact('question','quiz'));
    }
    public function deletequestion($id)
    {
        $question =  Quiz_questions::find($id);
        $question->delete();
        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }
    public function saveModalData(Request $request)
    {
        if ($request->input('question') != '') {
            $qu =   replaceimageeditor($request->input('question'));
        }
        if ( $request->input('description') != '') {
            $de =   replaceimageeditor($request->input('description'));

        }
        if ($request->input('id') == 0) {

            $data['question'] =  $qu ??$request->input('question');
            $data['description'] = $de ??$request->input('description');
            $data['mark'] = $request->input('degree');
            $data['quiz_id'] = $request->input('quiz_id');
            $q =  Quiz_questions::create($data);

          $answers = $request->input('answer');
            $answerIds = $request->input('answer_id');
            $correctIndex = $request->input('correct');


            foreach ($answers as $index => $answerText) {
                if ($answerText != '') {
                    $ans =   replaceimageeditor($answerText);
                }
                $answer['answer'] = $ans??$answerText;
                $answer['correct'] = ($index == $correctIndex) ? 1 : 0;
                $answer['question_id'] =  $q->id;
                Quiz_question_answers::create($answer);

            }
        } else {

        

            $question = Quiz_questions::find($request->input('id'));
            $question->question = $qu??$request->input('question');
            $question->description = $de?? $request->input('description');
            $question->mark = $request->input('degree');
            $question->save();

            $answers = $request->input('answer');
            $answerIds = $request->input('answer_id');
            $correctIndex = $request->input('correct');

            foreach ($answers as $index => $answerText) {
                if ($answerText != '') {
                    $ans =   replaceimageeditor($answerText);
                }
                $answer = Quiz_question_answers::find($answerIds[$index]);

                $answer->answer = $ans??$answerText;
                $answer->correct = ($index == $correctIndex) ? 1 : 0;
                $answer->save();
            }
        }
        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }
}
