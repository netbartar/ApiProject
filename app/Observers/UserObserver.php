<?php

namespace App\Observers;

use App\Events\NewRegisterEvent;
use App\Models\User;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Case_;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $users = User::all();
        Cache::forget('user-list3');
        Cache::put('user-list3',$users);
//        Cache::add('user-list3',$user);
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
