<?php

namespace App\Repository;

use App\Models\Blog;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\NotificationsRepositoryinterface;

class DBNotificationsRepository implements NotificationsRepositoryinterface
{
    protected Model $model;
    protected  $request;
    public function __construct(Notification $model,Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function get_notifications(){
        $nofi =$this->model->where('user_id', Auth::guard('student')->user()->id)->get();
      return  $nofi ;
    }
    public function read_notifications(){
        $nofi =$this->model->where(['user_id'=> Auth::guard('student')->user()->id ,'is_read'=>1])->update(['is_read'=>0]);
      if( $nofi){

          return true;
      }else{

          return false;
      }
    }


}
