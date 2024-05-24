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
        $course_id = $request->session()->get('course_id');
        return view('dashboard.new-course', compact(['course_id','stage', 'currentPage', 'category', 'triners', 'categoryfreecourse']));
    }
    public function save_course(Request $request)
    {
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
 
          return  'success';
        // return  redirect()->route('newcourse');
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
            'name'            => 'required',
            'category_id'     => 'required|exists:categories,id',
            'price'           => 'required',
            'pricewith'           => 'required',
            'startdate'       => 'required|date_format:Y/m/d',
            'enddate'         => 'required|date_format:Y/m/d',
            'time'            => 'required',
            'features'        => 'required',
            'howtostart'        => 'required',
            'target'        => 'required',
            'conditions'        => 'required',
            'short_description'        => 'required',
            'description'        => 'required',
            'triner'          => 'required',
            'limit_stud'      => 'required|integer',
            'validity' => 'required',
            'duration_course' => 'required',
        ],
        2 => [
            'image_course' => 'required',
            'schedule' => 'required',
            'file_work' => '',
            'file_explanatory' => '',
            'file_aggregates' => '',
            'file_supplementary' => '',
            'file_free' => '',
            'file_test' => ''
        ],
        3 => [
            'lessons.*.name' => 'required',
            'lessons.*.link' => 'required',
            'lessons.*.stage_id' => 'required',
            'lessons.*.publish_at' => 'required',
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
