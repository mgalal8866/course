<?php

namespace App\Repository;

use App\Models\CategoryGrades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryGradesRepositoryinterface;
use Illuminate\Http\Request;
class DBCategoryGradesRepository implements CategoryGradesRepositoryinterface
{

    protected Model $model;
    protected $request, $country;
    public function __construct(CategoryGrades $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_category()
    {
        $country = $this->request->header('country');
        return $this->model->where('country_id', $country)->orWhereNull('country_id')->whereActive(1)->get();

    }
}
