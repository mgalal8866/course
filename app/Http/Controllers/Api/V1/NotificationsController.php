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
        return $this->notificationsRepositry->get_notifications();
    }
    public function read_notifications()
    {
        return $this->notificationsRepositry->get_notifications();

    }
}
