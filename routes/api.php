<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SlotController;

Route::middleware('api')->group(function () {
    Route::get('/slots', [SlotController::class, 'index']);
    Route::get('/slot/{id}', [SlotController::class, 'show']);
    Route::post('/bonus/{slot}', [SlotController::class, 'activateBonus']);
    Route::post('/slots', [SlotController::class, 'store']);
});
