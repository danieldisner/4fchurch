<?php

use App\Http\Controllers\FinanceController;
use App\Models\Member;

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
})->withoutMiddleware(CheckPermission::class);

Route::get('/dashboard', function () {
    $totalMembers = Member::count();
    $membersByStatus = Member::select('status_id')
    ->selectRaw('count(*) as total')
    ->groupBy('status_id')
    ->with('status')
    ->get();
    return view('dashboard', compact('membersByStatus', 'totalMembers'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    Route::middleware([CheckPermission::class])->group(function () {
        Route::get('members/trash', [MemberController::class, 'trash'])->name('members.trash');
        Route::put('members/{id}/restore', [MemberController::class, 'restore'])->name('members.restore');
        Route::delete('members/{id}/forceDestroy', [MemberController::class, 'forceDestroy'])->name('members.forceDestroy');
        Route::get('/members/search', [MemberController::class, 'search'])->name('members.search');
        Route::resource('members', MemberController::class);

        Route::get('/finances', [FinanceController::class, 'index'])->name('finances.index');
        Route::post('/finances/add', [FinanceController::class, 'store'])->name('finances.store');
        Route::post('/finances/{id}/update', [FinanceController::class, 'update'])->name('finances.update');
        Route::get('/finances/data', [FinanceController::class, 'fetchData'])->name('finances.view');
    });
});

require __DIR__.'/auth.php';
