<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryBlogResource;
use App\Repositoryinterface\CategoryBlogRepositoryinterface;

class CategoryBlogController extends Controller
{
    private $categoryblog;
    public function __construct(CategoryBlogRepositoryinterface $categoryblog)
    {
        $this->categoryblog = $categoryblog;
    }

    function get_category_blog()
    {
        $data= $this->categoryblog->get_category_blog();
          return Resp(CategoryBlogResource::collection($data),'success');
    }
}
