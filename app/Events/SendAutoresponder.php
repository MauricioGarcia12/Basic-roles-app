<?php

namespace App\Events;

use App\Events\MessageWasReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendAutoresponder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
 

    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        $message=$event->message;

        Mail::send('emails.contact', ['msg' => $message], function ($m) use ($message) {

            $m->to($message->user->email, $message->user->name)->subject('Tu mensaje fue recibido');
        });
    }
}
