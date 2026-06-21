<?php

namespace App\Providers;

use App\Models\Member;
use App\Observers\MemberObserver;
use App\Policies\MemberPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Member::observe(MemberObserver::class);
        Gate::policy(Member::class, MemberPolicy::class);
    }
}
