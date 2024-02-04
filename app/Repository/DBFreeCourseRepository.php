<?php

namespace App\Repository;

use App\Models\FreeCourse;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\FreeCourseRepositoryinterface;
use Illuminate\Http\Request;

class DBFreeCourseRepository implements FreeCourseRepositoryinterface
{

    protected Model $model;
    protected $request;


    public function __construct(FreeCourse $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_free_course_by_category($id){
        $perPage = $this->request->input('per_page', 20);
        return $this->model->whereCategoryId($id)->paginate($perPage);
    }
    public function get_free_course_by_id($id){

        return $this->model->find($id);
    }
}
