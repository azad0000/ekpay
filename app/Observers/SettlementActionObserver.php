<?php

namespace App\Observers;

use App\Models\Settlement;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class SettlementActionObserver
{
    public function created(Settlement $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Settlement'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Settlement $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Settlement'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Settlement $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Settlement'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
