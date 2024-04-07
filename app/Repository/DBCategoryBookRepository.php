<?php

namespace App\Repository;

use App\Models\CategoryBook;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class DBCategoryBookRepository implements CategoryBookRepositoryinterface
{

    protected Model $model;
    protected $request;
    public function __construct(CategoryBook $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_category_book(){
        $country = $this->request->header('country');
        return $this->model->where('country_id', $country)->orWhereNull('country_id')->whereHas('book')->get();
    }
}
