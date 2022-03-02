<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class TransactionActionObserver
{
    public function created(Transaction $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Transaction'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
       // Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Transaction $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Transaction'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Transaction $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Transaction'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
