<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;

class GroupPolicy
{
    /**
     * Create a new policy instance.
     */
    public function isGroupAuthor(User $user, Group $group)
    {
        return $user->id === $group->author_id;
    }
}
