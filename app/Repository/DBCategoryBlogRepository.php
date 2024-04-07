<?php

namespace App\Repository;

use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryBlogRepositoryinterface;

class DBCategoryBlogRepository implements CategoryBlogRepositoryinterface
{


    protected Model $model;
    protected  $request;
    public function __construct(CategoryBlog $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;

    }
    public function get_category_blog()
    {
        $country = $this->request->header('country');
        return $this->model->where('country_id', $country)->orWhereNull('country_id')->whereHas('blog')->get();
    }
}
