<?php

use App\Models\Member;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin/print/dashboard', function () {
    $total = Member::count();
    $male = Member::where('sex', 'm')->count();
    $female = Member::where('sex', 'f')->count();

    $sancarlosCodes = ['105532000', '1804524000'];

    $inside = Member::whereIn('address_municipal', $sancarlosCodes)->get();
    $outside = Member::where(function ($q) use ($sancarlosCodes) {
        $q->whereNotIn('address_municipal', $sancarlosCodes)->orWhereNull('address_municipal');
    })->get();

    $allMembers = Member::orderBy('lastname')->get();

    $attendanceRanking = Member::withCount('attendances')
        ->get()
        ->sortByDesc(fn ($m) => $m->attendances_count)
        ->values();

    $achievementRanking = Member::with([
        'achievements.achievementLevel',
        'achievements.achievementPlacement',
    ])
        ->get()
        ->sortByDesc(fn ($m) => $m->achievement_points)
        ->values();

    return view('print.dashboard-report', compact(
        'total', 'male', 'female', 'inside', 'outside', 'allMembers', 'attendanceRanking', 'achievementRanking'
    ));
})->name('print.dashboard')->middleware(['web', 'auth']);
