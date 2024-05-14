<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Member;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalMembers = Member::count();
    $membersByStatus = Member::select('status_id')
    ->selectRaw('count(*) as total')
    ->groupBy('status_id')
    ->with('status')
    ->get();
    return view('dashboard', compact('membersByStatus', 'totalMembers'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('members', MemberController::class);
});

require __DIR__.'/auth.php';
