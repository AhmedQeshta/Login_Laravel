<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class increaseCounter
{
    /**
     * Create the event listener.
     *
     * @param VideoViewer $event
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param VideoViewer $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this->updateViewer($event->video);
    }

    function updateViewer($video){
        $video->viewers ++;
        $video->save();
    }
}
