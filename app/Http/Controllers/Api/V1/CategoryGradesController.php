<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategorygradeResource;
use App\Repositoryinterface\CategoryGradesRepositoryinterface;

class CategoryGradesController extends Controller
{
    private $category;
    public function __construct(CategoryGradesRepositoryinterface $category)
    {
        $this->category = $category;
    }

    public function get_category()
    {
        $cg = CategorygradeResource::collection($this->category->get_category());
      return Resp($cg,'success')  ;
    }


}
