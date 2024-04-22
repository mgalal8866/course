<?php

namespace App\Livewire\Dashboard\Notification;

use App\Models\Notification;
use Livewire\Component;

class ViewNotification extends Component
{
    public function render()
    {
        $notifcation = Notification::get();
        return view('dashboard.notification.view-notification',compact('notifcation'));
    }
}
