<?php

namespace App\Repository;

use App\Models\CategoryBlog;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryBlogRepositoryinterface;

class DBCategoryBlogRepository implements CategoryBlogRepositoryinterface
{

    protected Model $model;
    public function __construct(CategoryBlog $model)
    {
        $this->model = $model;
    }

    public function get_category_blog()
    {
        return $this->model->whereHas('blog')->get();
    }
}
