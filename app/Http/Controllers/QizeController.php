<?php

namespace App\Http\Controllers;

use App\Enum\Quiz;
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
    public function get_edit_quiz_Modal($quiz)
    {

        $quiz =  Quizes::find($quiz);
        $quiz = $quiz == null ? [] : $quiz;

        return view('dashboard.quizzes.edit-quiz-ajax', compact('quiz'));
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
        $countquiz =  Quiz_questions::where( 'quiz_id',$request->input('quiz_id'))->count();
        if ($request->input('id') == 0) {

            $data['question'] =  $qu ??$request->input('question');
            $data['description'] = $de ??$request->input('description');
            $data['mark'] = $request->input('degree');
            $data['quiz_id'] = $request->input('quiz_id');
            $data['sort'] =   $countquiz+1;
            
            $q =  Quiz_questions::create($data);

          $answers = $request->input('answer');
            $answerIds = $request->input('answer_id');
            $correctIndex = $request->input('correct');
            foreach ($answers as $index => $answerText) {
                if ($answerText != '') {
                    $ans =   replaceimageeditor($answerText);
                }
                $answer['answer'] = $ans??$answerText;
                $answer['correct'] = (($index+1) == $correctIndex ) ? 1 : 0;
                $answer['question_id'] =  $q->id;
                $answer['sort'] =  $index+1;
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
                $answer->correct = ($answerIds[$index] == $correctIndex) ? 1 : 0;
                $answer->save();
            }
        }
        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }
    public function save_edit_quiz_Modal(Request $request)
    {
 
        if ($request->input('quiz_id')  != '') {

            $data['quiz_id'] = $request->input(  'quiz_id');
            $quiz =  Quizes::find(  $data['quiz_id'] );

            if ($request->input('pass_marks') != '') {
                $quiz->pass_marks =  $request->input('pass_marks');
            }
            if ($request->input('time') != '') {
                $quiz->time =  $request->input('time');
            }
            if ($request->input('total_marks') != '') {
                $quiz->total_marks =  $request->input('total_marks');
            }
            if ($request->input('name') != '') {
                $quiz->name =  $request->input('name');
            }

            $quiz->save();


        }
        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }
}
