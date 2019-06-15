<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class AssignmentOfRoles extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $assignedRoles;

    public function __construct($user, $assignedRoles)
    {
        $this->user = $user;
        $this->assignedRoles = $assignedRoles;
    }

    public function build()
    {
        return $this->view('emails.assignment-of-roles')
            ->subject(__(':name, Assignment of new roles', ['name' => explode(" ", $this->user->name)[0]]));
    }
}
