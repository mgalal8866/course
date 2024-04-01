<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositoryinterface\ContentUsRepositoryinterface;

class ContentUsController extends Controller
{
    private $contentusRepositry;
    public function __construct(ContentUsRepositoryinterface $contentusRepositry)
    {
        $this->contentusRepositry = $contentusRepositry;
    }


    public function send_contentus()
    {
        $content = $this->contentusRepositry->send_contentus();
        if( $content != null){
          return Resp('','تم تلقى الطلب بنجاح',200);
        }else{
          return Resp('','No Blog','404');
        }
    }



}
