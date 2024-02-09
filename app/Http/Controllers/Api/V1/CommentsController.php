<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Repositoryinterface\CommentsRepositoryinterface;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    private $comment;
    public function __construct(CommentsRepositoryinterface $comment)
    {
        $this->comment = $comment;
    }

    public function add_comment_course(Request $request)
    {
        $comment = $this->comment->add_comment_course( $request);
      if( $comment != null){
        return Resp($comment,'Success');
      }else{
        return Resp('','No Comment','404');
      }
    }
    public function add_comment_freecourse(Request $request)
    {
        $comment = $this->comment->add_comment_freecourse( $request);

      if( $comment != null){
        return Resp($comment,'Success');
      }else{
        return Resp('','No Comment','404');
      }
    }


}
