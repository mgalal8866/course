<?php

namespace App\Repository;

use App\Models\CategoryBook;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use PhpParser\Node\Stmt\Return_;

class DBCategoryBookRepository implements CategoryBookRepositoryinterface
{

    protected Model $model;
    public function __construct(CategoryBook $model)
    {
        $this->model = $model;
    }

    public function get_category_book(){
        return $this->model->get();
    }
}
