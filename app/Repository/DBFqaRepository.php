<?php

namespace App\Repository;

use App\Models\Fqa;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\BlogRepositoryinterface;use App\Repositoryinterface\FqaRepositoryinterface;

class DBFqaRepository implements FqaRepositoryinterface
{
    protected Model $model;
    protected  $request;
    public function __construct(Fqa $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_fqa(){
        $fqa =$this->model->get();

      return  $fqa ;
    }

}
