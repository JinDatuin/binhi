<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class RestrictToMemberScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if (! $user) {
            return;
        }

        if ($user->hasRole('admin') || $user->hasRole('secretary')) {
            return;
        }

        if ($user->hasRole('member')) {
            $memberId = $user->member?->id;

            $memberId
                ? $builder->whereHas('members', function (Builder $query) use ($memberId): void {
                    $query->where('members.id', $memberId);
                })
                : $builder->whereRaw('1 = 0');
        }
    }
}
