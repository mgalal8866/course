<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Http\Resources\RatingCourseResultResource;
use App\Repositoryinterface\RatingRepositoryinterface;

class RatingController extends Controller
{
    private $ratingRepositry;
    public function __construct(RatingRepositoryinterface $ratingRepositry)
    {
        $this->ratingRepositry = $ratingRepositry;
    }


    public function get_rating_course()
    {
       $result =  $this->get_rating_result();
       if($result !=null){
           return $result;
       }
        $get_rating = $this->ratingRepositry->get_rating_course();
        if( $get_rating != null){
          return Resp(RatingResource::collection($get_rating), 'success', 200, true);
        }else{
          return Resp('','No Blog','404');
        }
    }
    public function get_rating_result()
    {
        $get_rating = $this->ratingRepositry->get_rating_result();
        if( $get_rating != null){
          return Resp(new RatingCourseResultResource($get_rating), 'success', 200, true);
        }else{
            return null;
        }
    }
    public function send_rating()
    {
        $get_rating = $this->ratingRepositry->send_rating_result();
        if( $get_rating != null){
            return Resp(new RatingCourseResultResource($get_rating), 'success', 200, true);
        }else{
          return Resp('','No Blog','404');
        }
    }



}
