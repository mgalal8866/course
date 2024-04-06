<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Repositoryinterface\NotificationsRepositoryinterface;

class NotificationsController extends Controller
{
    private $notificationsRepositry;
    public function __construct(NotificationsRepositoryinterface $notificationsRepositry)
    {
        $this->notificationsRepositry = $notificationsRepositry;
    }
    public function get_notifications()
    {
        $notifi = NotificationResource::collection($this->notificationsRepositry->get_notifications());
        return Resp( $notifi ,'success');
    }
    public function read_notifications()
    {
        $notifi = $this->notificationsRepositry->read_notifications();
        if($notifi){

            return Resp( '' ,'success');
        }else{

            return Resp( '' ,'error',400);
        }

    }
}
