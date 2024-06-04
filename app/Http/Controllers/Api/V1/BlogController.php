<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiBlogResource;
use App\Http\Resources\BlogResource;
use App\Repositoryinterface\BlogRepositoryinterface;

class BlogController extends Controller
{
    private $blogRepositry;
    public function __construct(BlogRepositoryinterface $blogRepositry)
    {
        $this->blogRepositry = $blogRepositry;
    }

    public function get_blog_by_category()
    {
        $get_blog = $this->blogRepositry->get_blog_by_category();
        if( $get_blog != null){
          return Resp(BlogResource::collection($get_blog), 'success', 200, true);
        }else{
          return Resp('','No Blog','404');
        }
    }
    public function get_blog_by_id()
    {
        $get_blog = $this->blogRepositry->get_blog_by_id();
        if( $get_blog != null){
            $get_blog->tags= [];
            $get_blog->save();
          return Resp(new ApiBlogResource($get_blog), 'success', 200, true);
        }else{
          return Resp('','No Blog','404');
        }

    }


}
