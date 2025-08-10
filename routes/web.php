<?php

use App\Livewire\Admin\Candidates as AdminCandidates;
use App\Livewire\Admin\Overview as AdminOverview;
use App\Livewire\Rankings;
use App\Livewire\Vote;
use App\Models\Vote as VoteModel;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = auth()->user();

    return view('dashboard', [
        'hasVoted' => ! $user->isAdmin() && VoteModel::where('voter_id', $user->id)->exists(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Previously this pointed at a view('vote') that didn't exist, so /vote
    // 500'd for every visitor. It now renders the real Livewire component.
    Route::get('/vote', Vote::class)->name('vote');
    Route::get('/results', Rankings::class)->name('results');

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Admin area: gated by the real `role` column + admin middleware, not a
// hardcoded email string.
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminOverview::class)->name('overview');
    Route::get('/candidates', AdminCandidates::class)->name('candidates');
});

require __DIR__.'/auth.php';
