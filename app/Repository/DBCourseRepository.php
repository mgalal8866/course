<?php

namespace App\Repository;

use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CourseRepositoryinterface;
use Illuminate\Http\Request;

class DBCourseRepository implements CourseRepositoryinterface
{

    protected Model $model;
    protected $request;
    
    public function __construct(Courses $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;

    }

    public function getcoursesbycategroy($category_id)
    {
        $perPage = $this->request->input('per_page', 20);
        return $this->model->whereCategoryId($category_id)->paginate($perPage);
    //    return $this->model->where('category_id',$category_id)->get();
    }
    public function getcoursebyid($id)
    {
    //    return $this->model->with('stages.lessons')->find($id);
       $course = $this->model->with(['stages' => function ($query) {
        $query->distinct();
    }, 'stages.lessons'])->find($id);
    return  $course ;
    }




}
