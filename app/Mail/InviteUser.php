<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class InviteUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $guestUser;
    public $userAuth;

    public function __construct($guestUser, $userAuth)
    {
        $this->guestUser = $guestUser;
        $this->userAuth = $userAuth;
    }

    public function build()
    {
        return $this->view('emails.invitation-to-the-platform')
            ->subject(__(':name, We invite you to our platform', ['name' => explode(" ", $this->guestUser->name)[0]]));
    }
}
