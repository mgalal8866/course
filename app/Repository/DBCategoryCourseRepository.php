<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;

class DBCategoryCourseRepository implements CategoryCourseRepositoryinterface
{

    protected Model $model;
    protected $request, $country;
    public function __construct(Category $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }


    public function getCategoryCourse()
    {

        $country = $this->request->header('country');
        return $this->model->where('country_id', $country)->orWhereNull('country_id')->whereHas('courses')->withCount('courses')->get();
    }
}
