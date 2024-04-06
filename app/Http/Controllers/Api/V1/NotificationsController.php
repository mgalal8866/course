<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
        return Resp( $this->notificationsRepositry->get_notifications() ,'success');
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
