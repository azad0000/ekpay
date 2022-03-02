<?php

namespace App\Observers;

use App\Models\Ipn;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class IpnActionObserver
{
    public function created(Ipn $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Ipn'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Ipn $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Ipn'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Ipn $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Ipn'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
