<?php

use App\Http\Controllers\OrderAssignmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/trigger-order-assignment', [OrderAssignmentController::class, 'triggerOrderAssignment'])
    ->name('trigger-order-assignment');
