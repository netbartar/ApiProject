<?php

namespace App\Observers;

use App\Events\NewRegisterEvent;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        NewRegisterEvent::dispatch();
    }

    public function saved(User $user): void
    {
//        Log::info('Welcome to my application!');
    }


    public function creating(User $user): void
    {
//        $user->name = strtoupper($user->name);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Log::info('Welcome to my application!');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
