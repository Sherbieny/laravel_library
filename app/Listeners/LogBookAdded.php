<?php

namespace App\Listeners;

use App\Events\BookAdded;
use Illuminate\Support\Facades\Log;

class LogBookAdded
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\BookAdded  $event
     * @return void
     */
    public function handle(BookAdded $event)
    {
        Log::info('Book added: ' . $event->book->title, ['book' => $event->book]);
    }
}
