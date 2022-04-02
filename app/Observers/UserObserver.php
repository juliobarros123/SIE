<?php

namespace App\Observers;
 
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
 
class UserObserver
{
    /**
     * Handle to the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // Dispatching Job SendWelcomeEmail
        SendWelcomeEmail::dispatch($user);
    }
 
    // [...]

}
