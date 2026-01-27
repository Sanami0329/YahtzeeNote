<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreatePlay;
use App\Livewire\PlayGame;
use App\Livewire\PreparePlay;
use App\Livewire\ScoreColumn;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/settings.php';

Route::get('/play/create', CreatePlay::class)->name('play.create');
Route::get('/play/prepare', PreparePlay::class)->name('play.prepare');
Route::get('/play/new-game', PlayGame::class)->name('play.game');
