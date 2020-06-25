<?php

namespace App\Policies;

use App\User;
use App\Holiday;
use Illuminate\Auth\Access\HandlesAuthorization;

class HolidayPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(User $user, Holiday $holiday)
    {
        return $user->id === $holiday->user_id;
    }
}
