<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use MongoDB\Driver\Session;

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
        if (!session()->has('videoIsVisited')){
            $this->updateViewer($event->video);
        }else{
            return false;
        }
    }

    function updateViewer($video){
        $video->viewers ++;
        $video->save();

        session()->put('videoIsVisited',$video->id);
    }
}
