<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Repositoryinterface\CategoryGradesRepositoryinterface;
use Illuminate\Http\Request;

class CategoryGradesController extends Controller
{
    private $category;
    public function __construct(CategoryGradesRepositoryinterface $category)
    {
        $this->category = $category;
    }

    public function get_category()
    {
      return  $this->category->get_category();
    }


}
