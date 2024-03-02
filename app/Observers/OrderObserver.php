<?php

namespace App\Observers;

use App\Events\CreateOrderEvent;
use App\Models\Order;
use App\Models\Product;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        if($order->qnt > 5 )
            CreateOrderEvent::dispatch($order,'jsdal');
//        CreateOrderEvent::dispatchIf($order->qnt > 5,$order,'x');
//        event(new CreateOrderEvent($order,'s'));

    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
