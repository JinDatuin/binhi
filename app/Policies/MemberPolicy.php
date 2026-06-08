<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;

class MemberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('Member.viewAny');
    }

    public function view(User $user, Member $member): bool
    {
        return $user->can('Member.view');
    }

    public function create(User $user): bool
    {
        return $user->can('Member.create');
    }

    public function update(User $user, Member $member): bool
    {
        return $user->can('Member.update');
    }

    public function delete(User $user, Member $member): bool
    {
        return $user->can('Member.delete');
    }
}
