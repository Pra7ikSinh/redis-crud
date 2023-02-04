<?php

namespace App\Listeners;

use App\Events\sendmail;
use App\Models\employee;
use Illuminate\Support\Facades\Mail;

class sendmailEventListener
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
     * @param  \App\Events\sendmail  $event
     * @return void
     */
    public function handle(sendmail $event)
    {
        // code to perform event written here in handle function

        $emp = employee::findOrfail($event->empID)->toArray();

        Mail::send('mail',$emp,function ($message) use ($emp) {
                $message->to('pratik.parmar@9spl.com')->subject
                    ('Laravel Basic Testing Mail');
                $message->from('testmailfromlaravel8@gmail.com', 'Pratik');
            });
    }
}
