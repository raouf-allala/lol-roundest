<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Vote::class);
Route::get('/results', \App\Livewire\Results::class);
