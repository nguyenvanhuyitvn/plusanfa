<?php

namespace App\Listeners;

use App\Events\HistoryStatusDevice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HistoryStatusListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  HistoryStatusDevice  $event
     * @return void
     */
    public function handle(HistoryStatusDevice $event)
    {
        //
    }
}
