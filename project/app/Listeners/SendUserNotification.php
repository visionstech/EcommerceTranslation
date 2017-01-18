<?php

namespace App\Listeners;
use App\User;
use App\Events\UserManageAction;
use Mail;

class SendUserNotification
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
     * @param  UserManageAction  $event
     * @return void
     */
    public function handle(UserManageAction $event)
    {
        $data=array('name'=>$event->name,
                    'email'=>$event->email,
                    'password'=>$event->password,
                    'domain'=>$event->website,
                    'overlays'=>$event->overlays,
                    'infusion'=>$event->infusion,
                    'dynamic_ads'=>$event->dynamic_ads,
                    'programmatic'=>$event->programmatic,
                );
       /* Mail::send('emails.user_created', $data, function($message) use ($data) {
            $message->to('qachd15@gmail.com');
            $message->subject('User Created');
        });*/
    }
}