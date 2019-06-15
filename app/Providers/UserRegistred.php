<?php

namespace App\Providers;

use App\GuestUser;
use App\Mail\AssignmentOfRoles;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserRegistred
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        if(GuestUser::where('email', $event->user->email)->exists()){
            try {
                $guestUser = GuestUser::where('email', $event->user->email)->first();
                $event->user->syncRoles(json_decode($guestUser->roles));
                Mail::to($event->user->email, $event->user->name)
                    ->send(new AssignmentOfRoles($event->user, json_decode($guestUser->roles)));
                $guestUser->delete();
            } catch (\Exception $e) {

            }
        }

    }
}
