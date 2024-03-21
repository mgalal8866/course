<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiBlogResource;
use App\Repositoryinterface\BlogRepositoryinterface;

class BlogController extends Controller
{
    private $blogRepositry;
    public function __construct(BlogRepositoryinterface $blogRepositry)
    {
        $this->blogRepositry = $blogRepositry;
    }

    public function getcart()
    {
        return Resp(ApiBlogResource::collection($this->blogRepositry->get_blog_by_id('a')), 'success', 200, true);
    }
    public function get_blog_by_category()
    {
        return Resp(ApiBlogResource::collection($this->blogRepositry->get_blog_by_category()), 'success', 200, true);
    }


}
