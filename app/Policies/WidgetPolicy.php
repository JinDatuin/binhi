<?php

namespace App\Policies;

use App\Models\User;

class WidgetPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('widget.viewAny');
    }

    public function view(User $user): bool
    {
        return $user->can('widget.view');
    }

    public function create(User $user): bool
    {
        return $user->can('widget.create');
    }

    public function update(User $user): bool
    {
        return $user->can('widget.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('widget.delete');
    }
}
