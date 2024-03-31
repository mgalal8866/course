<?php

namespace App\Repository;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\BlogRepositoryinterface;

class DBBlogRepository implements BlogRepositoryinterface
{
    protected Model $model;
    protected  $request;
    public function __construct(Blog $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_blog_by_id(){
        $id = $this->request->input('id', 1);
      return  $this->model->find($id);
    }
    public function get_blog_by_category(){
        $category_id = $this->request->input('category_id', 1);
        return $this->model->where('category_id',$category_id)->get();
    }

}
