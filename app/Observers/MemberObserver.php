<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function deleted(Member $member): void
    {
        $member->user?->delete();
    }
}
