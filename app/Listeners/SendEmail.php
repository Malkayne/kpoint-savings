<?php

namespace App\Listeners;

use App\Event\userCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class SendEmail
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
     * @param  userCreated  $event
     * @return void
     */
    public function handle(userCreated $event)
    {
        //
        $message = $event->email.",welcome to Bensomed Nigeria Enterprise";
        // redirectsession()->flash('greet', $message);
    //  redirect(route('smyl.login'))->with('greet',$message);
        return $message;

    }
}
