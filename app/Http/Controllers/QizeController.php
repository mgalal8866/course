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
        $quiz = Quizes::where('id', $request->id )->with(['question','question.answer'])->first();
        return view('dashboard.quizzes.view-questions', compact(['quiz']));
    }
    public function getModal($id)
    {

        $question =  Quiz_questions::with('answer')->find($id);
        return view('dashboard.quizzes.edit-header-ajax', compact('question'));
    }
    public function deletequestion($id)
    {
        $question =  Quiz_questions::find($id);
        $question->delete();
        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }
    public function saveModalData(Request $request)
    {
        $question = Quiz_questions::find($request->input('id'));
        $question->question = $request->input('question');
        $question->description = $request->input('description');
        $question->mark = $request->input('degree');
        $question->save();

        $answers = $request->input('answer');
        $answerIds = $request->input('answer_id');
        $correctIndex = $request->input('correct');

        foreach ($answers as $index => $answerText) {
            $answer = Quiz_question_answers::find($answerIds[$index]);
            $answer->answer = $answerText;
            $answer->correct = ($index == $correctIndex) ? 1 : 0;
            $answer->save();
        }

        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }

}
