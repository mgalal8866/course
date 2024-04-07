<?php

namespace App\Repository;

use App\Models\CategoryFCourse;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;
use Illuminate\Http\Request;

class DBCategoryFreeCourseRepository implements CategoryFreeCourseRepositoryinterface
{

    protected Model $model;
    protected $request, $country;
    public function __construct(CategoryFCourse $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_category_free_course()
    {
        $country = $this->request->header('country');
        return $this->model->where('country_id', $country)->orWhereNull('country_id')->active(1)->whereHas('freecourse')->get();
    }
}
