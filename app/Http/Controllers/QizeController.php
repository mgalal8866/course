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
use Illuminate\Support\Facades\Validator;

class QizeController extends Controller
{


    public function getquestion(Request $request)
    {
        $quiz = Quizes::where('id', $request->id )->with(['question','question.answer'])->first();
        return view('dashboard.quizzes.view-questions', compact(['quiz']));
    }

}
