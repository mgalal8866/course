<?php

namespace App\Repository;

use App\Models\Course;
use App\Models\Stages;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CourseRepositoryinterface;

class DBCourseRepository implements CourseRepositoryinterface
{

    protected Model $model;
    protected $request;

    public function __construct(Courses $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function getcoursesbycategroy($category_id)
    {
        return Cache::remember('course_category_' . $category_id, 60, function () use ($category_id) {
            $perPage = $this->request->input('per_page', 20);
            return $this->model->whereCategoryId($category_id)->with('courseenrolled')
                ->select(['id', 'name', 'image', 'short_description', 'created_at'])->paginate($perPage);
        });
    }
    public function getcoursebyid($id)
    {



        // $course = Cache::remember('course_full_' . $id, 60, function () use ($id) {
        $course = $this->model->with(
            [
                // 'stages._parent',
                'stagesparent',
                'coursetrainers.triner',
                'stages' => function ($query) use ($id) {
                    $query->distinct()->with(
                        [
                            '_parent' => function ($query) use ($id) {
                                $query->distinct();
                            },
                            'lessons' => function ($query) use ($id) {
                                $query->where('course_id', $id);
                            }
                        ]
                    );
                },'stages._parent'

            ]
        )->find($id);
        // });
        // dd($course);
        return  $course;
    }
}
