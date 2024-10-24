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

class NewCourseController extends Controller
{

    public function next_page(Request $request)
    {
        $currentPage = $request->input('current_step');
        $request->session()->pull('xx', $currentPage);
        if ($this->validateStep($request, 1)) {
            return $this->validateStep($request, 1);
        };
        return response()->json(['current_step' => $currentPage]);
    }
    public function getcategory(Request $request)
    {
        if ($request->id == null) {
            $stage = Stages::parent()->get();
        } else {
            $stage = Stages::where('parent_id', $request->id)->get();
        };
        return response()->json($stage, 200);
    }
    public function index(Request $request)
    {

        $currentPage = 3;
        $stage = Stages::parent()->get();
        $category = Category::get();
        $triners = User::whereType('1')->get();
        $categoryfreecourse = CategoryFCourse::whereHas('freecourse')->get();
        $course_id = $request->id??$request->session()->get('course_id');



        return view('dashboard.new-course', compact(['course_id','stage', 'currentPage', 'category', 'triners', 'categoryfreecourse']));

    }
    public function save_course(Request $request)
    {

        // $validator = Validator::make($request->all(), $this->validtionRules[1]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }
         
        $course_id = $request->inputcourse_id;

        foreach ($request['categories'] as $category ) {
            foreach ($category['subcategories'] as $subcategories) {
                foreach ($subcategories['inputs'] as $inputs) {

                    if ($inputs['type'] == 0) {
                        Quizes::updated(['id' => $inputs['link']], ['course_id' => $course_id]);
                    }
                    $lesson = Lessons::create(['name' => $inputs['name'], 'link_video' => $inputs['link'], 'is_lesson' => $inputs['type'], 'publish_at' => $inputs['date']]);
                    CourseStages::create(['course_id' => $course_id, 'lesson_id' => $lesson->id,'stage_id'=>$subcategories['subcategory_id'], 'publish_at' => $inputs['date']]);
                }
            }
        }
        session()->flash('swal_message', 'تم اضافه الكورس والدروس بنجاح');
        return  redirect()->route('course');
    }
    public function setCurrentStep(Request $request)
    {

        $v =  $this->validateStep($request, $request->currentStep);
        if ($v) {
            return  $v;
        }

        session(['currentStep' => $request->currentStep]);
        return response()->json(['currentStep' => $request->currentStep]);
    }
    private  $validtionRules = [
        1 => [
             'categories' => 'required|array|min:1',
            'categories.*.category_id' => 'required|exists:categories,id',
            'categories.*.subcategories' => 'required|array|min:1',
            'categories.*.subcategories.*.subcategory_id' => 'required|exists:subcategories,id',
            'categories.*.subcategories.*.inputs' => 'required|array|min:1',
            'categories.*.subcategories.*.inputs.*.type' => 'required|in:1,2,0',
            'categories.*.subcategories.*.inputs.*.date' => 'required|date',
            'categories.*.subcategories.*.inputs.*.name' => 'required|string|max:255',
            'categories.*.subcategories.*.inputs.*.link' => 'required|url',

        ],



    ];
    public function validateStep(Request $request, $step)
    {
        $validator = Validator::make($request->all(), $this->validtionRules[1]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }

        return response()->json(['success' => true]);
    }
}
