<?php

// use App\Http\Controllers\Public\CharacterController;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\Public\EntryController;
use App\Http\Controllers\Public\MetadataController;
use Illuminate\Support\Facades\Route;

Route::prefix('dictionary')->group(function () {

    Route::get('/entries', [EntryController::class, 'entries']);
    // Route::get('/entries/{entry:uuid}', [EntryController::class, 'show']);
    Route::get('/metadata', [MetadataController::class, 'metadata']);
    Route::get('/characters', [CharacterController::class, 'characters']);
    // Route::get('/characters/{character:uuid}', [CharacterController::class, 'show']);
});
