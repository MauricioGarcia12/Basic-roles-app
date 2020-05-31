<?php

namespace App\Events;

use App\Events\MessageWasReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
class SendNotificationToTheOwner
{
    

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

            $m->from($message->user->email, $message->user->name)
            ->to('mauricio@avanzadolaravel.com')
            ->subject('Tu mensaje fue recibido');
        });
    }
}
