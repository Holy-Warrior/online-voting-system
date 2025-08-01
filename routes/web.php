<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Vote;

// Route::get('/', function () {
//     return view('livewire.rankings');
// })->name('home');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/vote', function(){
    return view('vote');
})->middleware(['auth'])
    ->name('vote');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/vote', Vote::class)->name('vote');
// });

require __DIR__.'/auth.php';
